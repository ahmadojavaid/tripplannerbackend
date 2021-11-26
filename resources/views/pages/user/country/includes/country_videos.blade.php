@push('page-style')
<link rel="stylesheet" href="{{asset('user/style/video-plugin.css')}}" />
@endpush
<div class="page-section video-gallery">
  <div class="section-head">
    <h2 class="section-title mb-4">Videos about {{$country->name}}</h2>
    <p>
      {{$country->countryVideo->descrption}}
    </p>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 px-0 mb-5">
        <div class="wrap video-plugin mt-5">
          <div id="vid-gallery" class="popup gallery mfp-hide">
            <ul class="gallery-items list-unstyled d-flex flex-column justify-content-between">
              <li class="gallery-item" data-type="{{$country->countryVideo->getType($country->countryVideo->link_1)}}">
                <a href="{{$country->countryVideo->link_1}}" class="gallery-item-link"></a></li>
              <li class="gallery-item" data-type="{{$country->countryVideo->getType($country->countryVideo->link_2)}}">
                <a href="{{$country->countryVideo->link_2}}" class="gallery-item-link"></a></li>
              <li class="gallery-item" data-type="{{$country->countryVideo->getType($country->countryVideo->link_3)}}">
                <a href="{{$country->countryVideo->link_3}}" class="gallery-item-link"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
