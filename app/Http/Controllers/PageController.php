<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Mail;
use App\Mail\ContactForm;

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
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'subject' => 'required|min:3',
      'message' => 'required|min:10'
    ]);

    Mail::to('admin@example.com')->send(new ContactForm($request));

    return redirect('/');
  }
}
