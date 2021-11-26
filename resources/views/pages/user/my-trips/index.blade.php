@extends('layouts.user.contentLayoutMaster')
@section('content')
  <div class="my-trip pt-lg-5 pt-4">
    <div class="page-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <div class="section-content">
              <ul class="nav nav-tabs tab-light" id="myTab" role="tablist">
{{--                <li class="nav-item">--}}
{{--                  <a class="nav-link" id="city1-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="city1"--}}
{{--                     aria-selected="true">My Profile</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                  <a class="nav-link active show" id="city2-tab" data-toggle="tab" href="#trips" role="tab"
                     aria-controls="trips" aria-selected="true">My Trips</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
{{--                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="city2-tab">--}}
{{--                  @include('pages.user.profile.partials.update_profile')--}}
{{--                </div>--}}
                <div class="tab-pane fade  show active" id="trips" role="tabpanel" aria-labelledby="city1-tab">
                  @include('pages.user.my-trips.partials.my_trips')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('page-script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>
  <script src="{{asset('leaflet/leaflet.polylineDecorator.js')}}"></script>
  <script src="{{asset('leaflet/example.js')}}"></script>
  <script>
    $(document).ready(function(){

      init("map-1");
      init("map-2");
    });
  </script>
@endpush
@push('page-script')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />
@endpush
