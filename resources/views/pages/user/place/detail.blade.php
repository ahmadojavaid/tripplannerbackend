@extends('layouts.user.contentLayoutMaster')
@section('title', $place->name)

@section('content')
<div class="bottom-nav sticky-top">
  <div class="container">
    <ul class="" id="page-scroll-target">
      <li class="">
        <a class="active" href="#overview-scroll">Overview</a>
      </li>
      <li class="">
        <a class="" href="#properties-scroll">Properties</a>
      </li>
      <li class="">
        <a class="" href="#experiences-scroll">Experiences</a>
      </li>
      <li class="">
        <a class="" href="#blog-scroll">Blog Posts</a>
      </li>
    </ul>
  </div>
</div>
<div class="container">
  @include('pages.user.place.includes.breadcrumb')
  <div class="row">
    <div class="col-lg-8">
      @include('pages.user.place.includes.images')
      @include('pages.user.place.includes.essentials')
      @include('pages.user.place.includes.place_videos')
      @include('pages.user.place.includes.instagram')
      @include('pages.user.place.includes.properties')
      @include('pages.user.place.includes.experiences')
    </div>
    <div class="col-lg-4">
      <div class="drag-content mt-0 ">
        <div class="editor-card mw-100 d-flex flex-column">
          <h5 class="text-blue">{{$place->name}} </h5>
          <p class="more-text mb-2">
            {{$place->short_description}}
          </p>
          <a class="btn btn-secondary mb-lg-3 mb-3 w-50" href="{{route('user.enquire')}}">Enquire</a>
          <button class="btn-primary btn w-50" href="#">View this hotel</button>
        </div>
      </div>
    </div>
  </div>

  @include('pages.user.place.includes.articles')
</div>
@endsection
