@push('page-style')
<link rel="stylesheet" href="{{asset('user/style/video-plugin.css')}}" />
@endpush
@if (isset($videos['video-link']))
<div class="page-section video-gallery">
  <div class="container">
    <div class="row">
      <div class="col-12 mt-2 mb-5">
        <div class="embed-responsive embed-responsive-16by9 text-center">
          <iframe class="embed-responsive-item rounded" src="{{$videos['video-link']}}" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
@endif
