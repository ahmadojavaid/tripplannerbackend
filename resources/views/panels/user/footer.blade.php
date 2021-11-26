<div class="footer bg-dark">
  <div class="container">
    <div class="row border-bottom ">
      <div class="col-lg-3 col-md-12 d-flex justify-content-center justify-content-lg-start">
        <div class="footer-widget">
          <img src="{{ asset('user/images/trip-planner-logo.png') }}" alt="planner-logo" />
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer-widget">
          <h3 class="footer-title text-uppercase">Highlighted Destination</h3>
          <ul class="list-unstyled">

            @foreach ($higlightedCountries as $country)

            <li><a href="{{route('user.country.detail' , $country->slug)}}">{{$country->name}}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer-widget">
          <h3 class="footer-title text-uppercase">Get Inspired</h3>
          <ul class="list-unstyled">
            <li><a href="{{route('user.trip.index')}}">Trips</a></li>
            <li><a href="{{route('user.experience.index')}}">Experiences</a></li>
            <li><a href="{{route('user.blog.index')}}">Travel blog</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="footer-widget">
          <h3 class="footer-title text-uppercase">Contact US</h3>
          <ul class="list-unstyled">
            <li><a href="mailto: abc@example.com">abc@example.com</a></li>
            <li><a href="">address, street, City, Country</a></li>
            <li><a href="">+1 000 000000</a></li>
            <li><a href="">+1 000 000000</a></li>
          </ul>
          <div class="social-footer">
            <a href="#">
              <i class="fa fa-instagram"></i>
            </a>
            <a href="#">
              <i class="fa fa-pinterest"></i>
            </a>
            <a href="#">
              <i class="fa fa-facebook"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-lg-between justify-content-center align-items-center">
      <div class="footer-bottom">
        <a href="{{route('user.about-us')}}" class="mr-3">About Us</a>
        <a href="#">Term and Conditions</a>
      </div>
      <div class="footer-bottom">
        <p>All right reserved. all rights reserved information here</p>
      </div>
    </div>
  </div>
</div>
