{{-- Custom Theme styling --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
  integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://use.fontawesome.com/b7e5bcc19f.css" media="all" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset('user/style/style.css') }}">
<link rel="stylesheet" href="{{ asset('user/style/theme-style.css') }}">

<style>
  .leaflet-container .stage-marker.highlighted-location {
    background: #E52745;
  }


  .leaflet-marker-icon:hover {
    background: white !important;
  }

  .leaflet-marker-icon:hover::after {
    background: #3c74b4;
  }

  .leaflet-popup-content {
    /* width: 280px !important; */
    margin: 0 !important;
  }
  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
@php
$configData = Helper::applClasses();
@endphp
@stack('page-style')
