@extends('template')

@section('content')
  <div class="container">
    <div class="row">

      <div class="col-md-6 col-md-offset-3">
        <h1>{{ $address->formatted_address }}</h1>
        <hr />

        <p>
          {{ $weather->hourly->summary }}
        </p>

        <ul>
          <li>Current Temp: {{ $weather->currently->temperature }}</li>
          <li>Feels Like: {{ $weather->currently->apparentTemperature }}</li>
          <li>Wind Speed: {{ $weather->currently->windSpeed }}mph</li>
        </ul>
      </div>

    </div>
  </div>
@endsection
