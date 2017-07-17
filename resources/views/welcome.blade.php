<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
      <div class="container">

        <div class="jumbotron">
          <h1>Ask a Question!</h1>
          <p>Ask any question you want to know and we will get the answers for you.</p>
          <p><a href="#" class="btn btn-primary btn-lg" role="button">Ask Now</a>
        </div>

        <h2>Recent Questions:</h2>

        @foreach ($questions as $question)
        <div class="well">
          <p class="lead">{{ $question }}</p>
        </div>
        @endforeach

      </div>
    </body>
</html>
