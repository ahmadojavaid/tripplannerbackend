<div class="container" id="property-data-details" {{-- airport-id="{{$airport->id}}"
  airport-latitude="{{$airport->latitude}}" airport-longitude="{{$airport->longitude}}" property-id="{{$property->id}}"
  --}} property-latitude="{{$property->latitude}}" property-longitude="{{$property->longitude}}"
  property-id="{{$property->id}}" place-id="{{$property->place_id}}">
  @include('pages.user.property.includes.breadcrumb')
  <div class="row">
    <div class="col-lg-8">
      @include('pages.user.property.includes.images')
      @include('pages.user.property.includes.essentials')
      @include('pages.user.property.includes.property_videos')
    </div>
  </div>
</div>
