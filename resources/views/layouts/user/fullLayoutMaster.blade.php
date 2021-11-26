<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') - Trip Planner</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/logo/favicon.ico">

  {{-- Include core + vendor Styles --}}
  @include('panels.user.styles')

</head>

{{-- {!! Helper::applClasses() !!} --}}
@php
$configData = Helper::applClasses();
@endphp

@php
$configData = Helper::applClasses();
@endphp

<body>
  {{-- @include('panels.user.navbar') --}}

  <!-- BEGIN: Header-->
  {{-- Include Navbar --}}
  @yield('content')


  {{-- include footer --}}
  {{-- @include('panels.user.footer') --}}

  {{-- include default scripts --}}
  @include('panels.user.scripts')

</body>

</html>
