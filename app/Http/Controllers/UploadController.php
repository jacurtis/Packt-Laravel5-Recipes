<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Auth;
use Image;

class UploadController extends Controller
{
  public function getUpload()
  {
    return view('upload');
  }

  public function postUpload(Request $request)
  {
    $user = Auth::user();
    $file = $request->file('picture');

    $filename = uniqid($user->id."_").".".$file->getClientOriginalExtension();
    Storage::disk('s3')->put($filename, File::get($file), 'public');

    $url = Storage::disk('s3')->url($filename);
    $user->profile_pic = $url;
    $user->save();

    // process, resize, and crop our image into a thumbnail
    $thumb = Image::make($file);
    $thumb->fit(200);
    $jpg = (string) $thumb->encode('jpg');

    // 3) rename the file so we know its a thumbnail
    $thumbName = pathinfo($filename, PATHINFO_FILENAME).'-thumb.jpg';
    // 4) save into our storage
    Storage::disk('s3')->put($thumbName, $jpg, 'public');

    return view('upload-complete')->with('filename', $filename)->with('url', $url);
  }
}
