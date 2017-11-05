@extends('template')

@section('content')
  <div class="container">
    <div class="row">

      <div class="col-md-6 col-md-offset-3">
        <h1>File Uploaded</h1>
        <hr />

        <div class="text-center">
          <img src="{{ $url }}" class="img-rounded" />
        </div>

        <ul style="margin: 20px;">
          <li><strong>Filename: </strong>{{ $filename }}</li>
          <li><strong>Storage Path: </strong>{{ $url }}</li>
        </ul>

        <div class="row">
          <div class="col-md-4">
            <a href="{{ route('index') }}" class="btn btn-default" style="width:100%;">Go Home</a>
          </div>
          <div class="col-md-4">
            <a href="{{ route('upload') }}" class="btn btn-default" style="width:100%;">Upload Again</a>
          </div>
          <div class="col-md-4">
            <a href="{{ route('profile', Auth::id()) }}" class="btn btn-default" style="width:100%;">View Profile</a>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
