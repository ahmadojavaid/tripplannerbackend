@extends('layouts.user.contentLayoutMaster')
@section('title', $country->name)

@section('content')
<div class="container">
  @include('pages.user.country.includes.breadcrumb')
  <div class="row">
    <div class="col-lg-8">

      @include('pages.user.country.includes.images')
      @include('pages.user.country.includes.essentials')
      @include('pages.user.country.includes.itineraries')
      @include('pages.user.country.includes.country_videos')
      @include('pages.user.country.includes.places')


      {{-- <div class="page-section">
        <div class="section-content">
          <div class="how-works">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <div class="start-planing py-5 ">
                    <h3 class="mb-3">How it works</h3>
                    <p class="mb-3">Make your own trip to South America
                      Make your own trip to South America
                    </p>
                    <button class="btn-primary btn" href="#">View all highlighted trips</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
    </div>
    <div class="col-lg-4">
      <div class="drag-content mt-0 ">
        <div class="editor-card mw-100 d-flex flex-column">
          <h5 class="text-blue">{{$country->name}} </h5>
          <p class="more-text mb-2">
            {{$country->short_description}}
          </p>
          <a class="btn btn-secondary mb-lg-3 mb-3 w-50" href="{{route('user.enquire')}}">Enquire</a>
          <button class="btn-primary btn w-50" href="#">View this hotel</button>
        </div>
      </div>
    </div>
  </div>

  @include('pages.user.country.includes.articles')


</div>
@endsection
