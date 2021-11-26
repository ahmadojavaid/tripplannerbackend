@push('page-style')
<link rel="stylesheet" href="{{asset('user/style/video-plugin.css')}}" />
@endpush
<div class="page-section video-gallery">
  <div class="section-head">
    <h2 class="section-title mb-4">Videos about {{$place->name}}</h2>
    <p>
      {{isset($videos['video-description']) ? $videos['video-description']: null}}
    </p>
  </div>
  @php
  $link1 = isset($videos['video-link-1']) ? $videos['video-link-1']: null;
  $link2 = isset($videos['video-link-2']) ? $videos['video-link-2']: null;
  $link3 = isset($videos['video-link-3']) ? $videos['video-link-3']: null;
  @endphp
  <div class="container">
    <div class="row">
      <div class="col-lg-12 px-0 mb-5">
        <div class="wrap video-plugin mt-5">
          <div id="vid-gallery" class="popup gallery mfp-hide">
            <ul class="gallery-items list-unstyled d-flex flex-column justify-content-between">
              <li class="gallery-item" data-type="{{Str::contains($link1, 'vimeo') ? "vimeo" : "youtube"}}">
                <a href="{{$link1}}" class="gallery-item-link"></a></li>
              <li class="gallery-item" data-type="{{Str::contains($link2, 'vimeo') ? "vimeo" : "youtube"}}">
                <a href="{{$link2}}" class="gallery-item-link"></a></li>
              <li class="gallery-item" data-type="{{Str::contains($link3, 'vimeo') ? "vimeo" : "youtube"}}">
                <a href="{{$link3}}" class="gallery-item-link"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
