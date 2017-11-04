<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use File;

class UploadController extends Controller
{
  public function getUpload()
  {
    return view('upload');
  }

  public function postUpload(Request $request)
  {
    $file = $request->file('picture');
    Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));

    return view('upload-complete')->with('filename', $filename);
  }
}
