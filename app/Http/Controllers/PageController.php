<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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

  public function profile($id)
  {
    $user = User::with(['questions', 'answers', 'answers.question'])->find($id);
    return view('profile')->with('user', $user);
  }

  public function contact()
  {
    return view('contact');
  }

  public function sendContact(Request $request)
  {
    // Send and process the email
  }
}
