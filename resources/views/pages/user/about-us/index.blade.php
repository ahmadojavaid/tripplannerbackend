@extends('layouts.user.contentLayoutMaster')
@section('title','About Us')
@section('content')
<div class="page-section pt-3 pt-md-5">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">
About The Route Makers
      </h2>
      <div class="section-content">
        <p class="">
Preparing the trip of your dreams to South America is easier than ever. Our content-rich site enables you to explore a destination’s offerings and create personalized itineraries. We give you all the possible routes and the most recommended experiences and properties within each destination. Even the craziest ideas you come up with can be reviewed by local experts.
        </p>
        <p class="">
          You will be in charge of the sexiest and funniest part of travel planning, the one we leave to the artists: designing your travel story throughout South America. You control your expenses and you propose new ideas. We only give you the canvas and the materials. The research and verification has already been done by us - We have even been looking for suppliers that offer the best payment policies.
        </p>
        <p class="">
         We know every corner of the continent in detail and we want to be your mentor in this process.
        </p>

      </div>
    </div>
  </div>
</div>
<div class="page-section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">
        How it works
      </h2>
    </div>
    <div class="section-content">
      <div class="how-works">
        <div class="container">
          <div class="row no-gutters mb-5">
            <div class="col-lg-6">
              <div class="video-grid embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item video-icon" src="{{$setting->getHowItWorkVideo()}}"
                  controls="true"></video>
                <div class="playpause-icon"></div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="start-planing">
                <h3 class="mb-3">How it works</h3>
                <p class="mb-3">
                  Take control of your trip, propose every stupid idea you might have and you will count with the knowledge & guidance of the best travel experts in South America.
                </p>
{{--                <button class="btn-primary btn" href="#">--}}
{{--                  View all highlighted trips--}}
{{--                </button>--}}
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <!--                                <div class="border-steps">-->

              <!--                                </div>-->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="work-steps">
                <div class="mb-3">
                  <h4 class="lead-text">First...</h4>
                  <h4>Click on New Trip</h4>
                </div>

              </div>
            </div>
            <div class="col-lg-4">
              <div class="work-steps">
                <div class="mb-3">
                  <h4 class="lead-text">Then...</h4>
                  <h4>Select Destinations, properties and experiences</h4>
                </div>

              </div>
            </div>
            <div class="col-lg-4">
              <div class="work-steps">
                <div class="mb-3">
                  <h4 class="lead-text">And...</h4>
                  <h4>Save your trips, share with friends and inquire!</h4>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-section">
  <div class="bg-yellow py-3 py-lg-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="services-card">
            <h2 class="">
              What we Will do...
            </h2>
          </div>
          <div class="services-card">
            <h3>
              1. You control your budget
            </h3>
            <p>
              You decide your budget, we will give you the best hotels and experiences while saving you some pennies.
            </p>
          </div>
          <div class="services-card mb-lg-0 mb-5">
            <h3>
              2. Customized and total flexibility
            </h3>
            <p>
             Design a route as individual as you are! We will  give you the best advice based on your created trips.
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="services-card">
            <h3>
              3. Funniest way to travel
            </h3>
            <p>
             You explore and create; we will work out the details.
            </p>
          </div>
          <div class="services-card">
            <h3>
              4. Flexible booking policies
            </h3>
            <p>
              We work with hotels and local operators offering flexible cancellation policies.
            </p>
          </div>
          <div class="services-card mb-0">
            <h3>
              5. Only for Creative people
            </h3>
            <p>
              Become a travel artist and design the best experience.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="page-section pt-3 pt-md-5">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">
        Our Manifesto
      </h2>
      <div class="section-content">
        <p class="">
          You are an artist who loves stories with romance, adventure, passionate characters and exotic destinations.
        </p>
        <p class="">
         You are curious about the world, don’t want to miss a single thing, always gathering information, in search of the rare, unexplored experiences that this world has to offer.
        </p>
        <p class="">
          You are a dreamer. constantly dreaming up exceptional new trips, whisking you off to the most unique corners of the globe.
        </p>
        <p class="">
         You design your own experience in locations so untouched that you are sure that no one else has experienced it before in the same way.
        </p>
        <p class="">
You are an Artist of travel.
        </p>
        <p class="">
          You are part of  The Route Makers.
        </p>

      </div>
    </div>
  </div>
</div>

@endsection
