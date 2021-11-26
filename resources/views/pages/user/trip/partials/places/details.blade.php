<div class="container" id="place-data-details" airport-id="{{$airport->id}}" airport-latitude="{{$airport->latitude}}"
  airport-longitude="{{$airport->longitude}}" place-id="{{$place->id}}" place-latitude="{{$place->latitude}}"
  place-longitude="{{$place->longitude}}">
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
  </div>
</div>
