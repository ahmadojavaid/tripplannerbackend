{{--
  Simple navbar
  Types: Simple , Combined
  Default : Simple

--}}


@if (!isset($data['layout']) )
@php
if(!isset($navbarOptions['type']))
$classes= "sticky-top navbar-dark bg-dark";
else if(isset($navbarOptions['type']) && $navbarOptions['type'] =="combined")
$classes= "navbar-light";

@endphp

<nav class="navbar navbar-expand-lg {{$classes}}  with-menu">

  <div class="container-nav">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-custom"
      aria-controls="exCollapsingNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <!--just add these span here-->
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <!--/end span-->
    </button>
    <div class="navbar-brand p-0 m-0">
      <a id="planner-logo" title="planner " href="{{route('user.dashboard')}}">
        <img src="{{ asset('user/images/trip-planner-logo.png') }}" alt="planner-logo" />
      </a>

    </div>
    <div class="special-nav-btn d-lg-none d-flex">
      <a class="btn-primary btn" href="#">New Trip</a>
    </div>

    <div class="navbar-collapse collapse" id="navbar-custom">
      <ul class="navbar-nav left-nav">
        <li class="nav-item dropdown position-static">
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" data-target="#">Destinations</a>
          <div class="dropdown-menu dropdown-menu-left mega-dropdown">
            @include('panels.user.includes.destination')
          </div>
        </li>
        <li class="nav-item"><a title="Trips" href="{{route('user.trip.index')}}" class="nav-link">Trips</a>
        </li>
        <li class="nav-item"><a title="Experiences" href="{{route('user.experience.index')}}" class="nav-link">Top
            Experiences</a>
        </li>
        <li class="nav-item"><a title="About Us" href="{{route('user.about-us')}}" class="nav-link">About Us</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav align-items-center">
          <li class="nav-item d-lg-flex d-md-none d-sm-none d-none">
            <a class="btn-primary btn" href="{{route('user.trip.create.index')}}">New Trip</a>
          </li>
          <li class="nav-item">
            @guest
            <a class="nav-link login-btn" href="javascript:void(0)" data-toggle="modal"
              data-target="#login-modal">Login</a>
            @endguest
            @auth
            <div class="dropdown">
              <img class="user-icon dropdown-toggle" id="user-icon-dropdown"
                src="{{auth()->guard('web')->user()->getAvatar()}}" alt="" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-icon-dropdown">
                <a class="dropdown-item" href="{{route('user.profile')}}">My Profile</a>
                <a class="dropdown-item" href="{{route('user.my-trips')}}">My Trip</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('user.auth.logout')}}">Log out</a>
              </div>
            </div>
            @endauth
          </li>
        </ul>
      </ul>
    </div>
  </div>
</nav>

@elseif(isset($data['layout']) && $data['layout'] == "trip")

{{-- Need to implement for  trip creation navbar --}}
<nav class="navbar-expand-lg sticky-top navbar-light without-menu-nav trip-simple-navbar">
  <div class="container">

    <div class="navbar-brand p-0 m-0">
      <a id="planner-logo" title="planner " href="{{route('user.dashboard')}}">
        <img src="{{asset('user/images/trip-planner-logo.png')}}" alt="planner-logo">
      </a>
    </div>

    <div class="xyz-nax" id="navbar-custom">
      <ul class="navbar-nav left-nav">
        @if(!isset($start_date) && !isset($end_date))
        <li class="nav-item"><a title="Trip" href="" class="nav-link lead-text">Create your Trip</a>
        </li>
        @endif
      </ul>
      <ul class="navbar-nav ml-auto align-items-center nav-right">
        <li class="nav-item">
          <div class="header-price d-none d-lg-block  mr-3 mr-lg-5 pr-0 pr-lg-5">
            <p class="lead-text trip-price">
              @if(isset($usertrip->price))
              <span>{{$usertrip->price}}$</span> per person
              @endif
            </p>
            <p class="head-date trip-date">
              @if(isset($start_date) && isset($end_date))
                {{$start_date}} - {{$end_date}}
              @endif
            </p>
          </div>
        </li>
        <li class="nav-item d-none d-md-block ">
          @if(!isset($start_date) && !isset($end_date))

          <button disabled class="btn-light btn mr-2 save-tripx" href="#">Save Trip</button>
          @endif
        </li>
        <li class="nav-item d-none d-md-block ">
          <a class="btn-primary btn" href="{{route('user.enquire')}}">Enquire</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



<nav class="navbar-expand-lg sticky-top navbar-light without-menu-nav space-left tab-navbar trip-custom-navbar d-none">
  <div class="container">
    <div class="navbar-brand p-0 m-0">
      <a href="" class="back-btn"><i class="fa fa-chevron-left align-middle" aria-hidden="true"></i>
        back</a>
      <a id="planner-logo" title="planner " href="{{route('user.dashboard')}}">
        <img src="{{asset('user/images/trip-planner-logo.png')}}" alt="planner-logo">
      </a>
    </div>

    <div class="xyz-nax" id="navbar-custom">
      <ul class="navbar-nav left-nav">
        <li class="nav-item">
          <a title="Experiences" href="javascript:void(O)" class="nav-link">Quito</a>
          <div class="header-price d-none d-md-block mr-3 mr-lg-5 pr-0 pr-lg-5"></div>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto align-items-center nav-right">


        <li class="nav-item mr-3 mr-lg-5">
          <a class="btn-primary btn add-to-itinerary" href="javascipt:void(0)">Add to Itinerary</a>
        </li>
        <li class="nav-item align-middle"><i class="fa fa-times"></i></li>
      </ul>
    </div>
  </div>
</nav>
@endif
@guest
@include('pages.user.auth.login')
@include('pages.user.auth.register')
@include('pages.user.auth.passwords.email')
@endguest
