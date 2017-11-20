@extends('template')

@section('content')
  <div class="container" id="app">
    <div class="row">

      <div class="col-md-6 col-md-offset-3" v-if="step == 1">
        <h1>Enter an Address to get Weather</h1>
        <hr />

        <form>
          {{ csrf_field() }}

          <input type="text" name="location" style="margin: 20px 0;" class="form-control" placeholder="Enter a Zipcode or Address" v-model="userInput"/>
          <button class="btn btn-primary" style="width:100%;" v-show="userInput" v-on:click.prevent="submitAddress" />Get Weather</button>
        </form>
      </div>

      <div class="col-md-6 col-md-offset-3" v-if="step == 2">
        <h1>@{{ googleAddress.formatted }}</h1>
        <hr />

        <ul>
          <li>Lat: @{{ googleAddress.lat }}</li>
          <li>Lng: @{{ googleAddress.lng }}</li>
        </ul>

        <p>
          @{{ darksky.summary }}
        </p>

        <ul>
          <li>Current Temp: @{{ darksky.currentTemp }}</li>
          <li>Feels Like: @{{ darksky.feelsLikeTemp }}</li>
          <li>Wind Speed: @{{ darksky.windSpeed }} mph</li>
        </ul>
      </div>

    </div>
  </div>
@endsection

@section('scripts')
<script>
  var app = new Vue({
    el: '#app',
    data: {
      step: 1,
      userInput: '',
      googleAddress: {
        pretty: '',
        lat: '',
        lng: ''
      },
      darksky: {
        summary: '',
        currentTemp: '',
        feelsLikeTemp: '',
        windSpeed: ''
      }
    },
    methods: {
      submitAddress: function() {
        this.step = 2;
        let vm = this;
        axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
          params: {
            address: this.userInput
          }
        }).then(function (response) {
          let res = response.data.results[0];
          vm.googleAddress.formatted = res.formatted_address;
          vm.googleAddress.lat = res.geometry.location.lat;
          vm.googleAddress.lng = res.geometry.location.lng;
          //vm.res = response
          let darkskyApi = '{{ env('DARKSKY_API') }}';
          let corsAnywhere = 'https://cors-anywhere.herokuapp.com/';
          let url = `${corsAnywhere}https://api.darksky.net/forecast/${darkskyApi}/${res.geometry.location.lat},${res.geometry.location.lng}`
          return axios.get(url);
        }).then(function (response) {
          let res2 = response.data;
          vm.darksky.summary = res2.currently.summary;
          vm.darksky.currentTemp = res2.currently.temperature;
          vm.darksky.feelsLikeTemp = res2.currently.apparentTemperature;
          vm.darksky.windSpeed = res2.currently.windSpeed;
        });
      }
    }
  });
</script>
@endsection
