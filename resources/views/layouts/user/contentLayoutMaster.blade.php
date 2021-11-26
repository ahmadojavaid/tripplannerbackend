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
<body>

  @include('panels.user.navbar')

  <!-- BEGIN: Header-->
  {{-- Include Navbar --}}
  @yield('content')


  @if (!isset($data['footer'] ) || (isset($data['footer']) && $data['footer'] !=false) )
  @include('panels.user.footer')
  @endif
  {{-- @yield('secondary-content') --}}

  {{-- include default scripts --}}
  @include('panels.user.scripts')

</body>

</html>
