@extends('layouts.user.contentLayoutMaster')
@section('title', $experience->title)

@section('content')
<div class="bottom-nav sticky-top" id="overview-scroll">
  <div class="container">
    <ul class="" id="page-scroll-target">
      <li class="">
        <a class="active" href="#overview-scroll">Overview</a>
      </li>
      <li class="">
        <a class="" href="#inpiration-scroll">Inspiration</a>
      </li>

    </ul>
  </div>
</div>
<div class="container">
  @include('pages.user.experience.includes.breadcrumb')
  <div class="row">
    <div class="col-lg-8">
      @include('pages.user.experience.includes.images')
      @include('pages.user.experience.includes.essentials')
      @include('pages.user.experience.includes.experience_videos')
    </div>


    <div class="col-lg-4">
      <div class="drag-content mt-0">
        <div class="editor-card mw-100">
          <h5 class="text-blue mb-2 mb-md-3 mb-lg-3">{{$experience->title}}</h5>
          <p class="lead-text">${{$experience->price}} per person</p>
          <p class="more-text mb-2 mb-lg-3">
            {{$experience->short_description}}
          </p>
          <div class="arrival-date">
            <div class="form-group date-button">
              <input type="button" name="datefilter" value="Arrival Date" class="" />
              <i class="fa fa-calendar"></i>
            </div>
            <button class="btn-primary btn " href="#">Add to Itinerary</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
