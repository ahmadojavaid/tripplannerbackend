<div class="container" id="experience-data-details" {{-- airport-id="{{$airport->id}}"
  airport-latitude="{{$airport->latitude}}" airport-longitude="{{$airport->longitude}}"
  experience-id="{{$experience->id}}" --}} experience-latitude="{{$experience->latitude}}"
  experience-longitude="{{$experience->longitude}}" experience-id="{{$experience->id}}"
  place-id="{{$experience->place_id}}">
  @include('pages.user.experience.includes.breadcrumb')
  <div class="row">
    <div class="col-lg-8">
      @include('pages.user.experience.includes.images')
      @include('pages.user.experience.includes.essentials')
      @include('pages.user.experience.includes.experience_videos')
    </div>
  </div>
</div>
