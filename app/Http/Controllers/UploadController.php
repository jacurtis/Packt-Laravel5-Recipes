<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;
use Auth;

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
    // 1_JDHnshshj387373.png
    Storage::disk('s3')->put($filename, File::get($file), 'public');

    // update the user record with the new profile pic filename
    $url = Storage::disk('s3')->url($filename);
    $user->profile_pic = $url;
    $user->save();

    return view('upload-complete')->with('filename', $filename)->with('url', $url);
  }
}
