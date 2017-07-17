<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
  public function index()
  {
    $questions = [
      'Why is Laravel So Awesome?',
      'Why do we need Routes?',
      'How do I make a Model talk to our Database?',
      'Do you like to use Bootstrap with Laravel?'
    ];
    return view('welcome')->with('questions', $questions);
  }

  public function about()
  {
    return "ABOUT US PAGE";
  }
}
