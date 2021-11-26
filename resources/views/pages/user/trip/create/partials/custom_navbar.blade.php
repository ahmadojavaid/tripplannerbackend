<nav class="navbar-expand-lg sticky-top navbar-light without-menu-nav">
  <div class="container">
    <div class="navbar-brand p-0 m-0">
      {{-- <a id="planner-logo" title="planner " href="index.html">
        <img src="images/trip-planner-logo.png" alt="planner-logo" />
      </a> --}}
      <a id="planner-logo" title="planner " href="{{route('user.dashboard')}}">
        <img src="{{asset('user/images/trip-planner-logo.png')}}" alt="planner-logo">
      </a>
    </div>

    <div class="xyz-nax" id="navbar-custom">
      <ul class="navbar-nav left-nav">
        <li class="nav-item">
          <a title="Trip" href="" class="nav-link lead-text">Create your Trip</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto align-items-center nav-right">
        <li class="nav-item">
          <div class="header-price d-none d-lg-block mr-3 mr-lg-5 pr-0 pr-lg-5">
            <p class="lead-text"><span>50$</span> per person</p>
            <p class="head-date">20 May 21 - 22 May 2021</p>
          </div>
        </li>
        <li class="nav-item d-none d-md-block">
          <button class="btn-light btn mr-2" href="#">New Trip</button>
        </li>
        <li class="nav-item d-none d-md-block">
          <button class="btn-primary btn" href="#">Enquire</button>
        </li>
      </ul>
    </div>
  </div>
</nav>
