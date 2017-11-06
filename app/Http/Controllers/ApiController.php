<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleClient;

class ApiController extends Controller
{
  public function github($username)
  {
    // https://api.github.com/users/jacurtis
    $client = new GuzzleClient();
    $response = $client->get("https://api.github.com/users/$username");
    $body = json_decode($response->getBody());

    print "Name: $body->name <br />";
    print "Location: $body->location <br />";
    print "Bio: $body->bio <br />";
  }
}
