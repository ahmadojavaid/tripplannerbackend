<div class="section-content border-bottom pb-4 mb-4">
  <div class="icon-heading tinny-view">
    <h3>
      <img src="{{asset('user/images/experience-lead.png')}}" alt="">
      <span>Experiences in </span> {{$experience->experiencePlace->name}}
    </h3>
    <button class="right-bottom btn btn-light py-1">Edit</button>
  </div>
  <div class="icon-head-content readmore">
    <span class="readmore-link"></span>
  </div>
  <div class="info-with-images">
    <h3>{{$experience->title}}</h3>
    <p>Price: <span>{{$experience->price}}$</span> per night, per person</p>
    <div class="row mt-3">
      @foreach ($experience->experienceFiles->take(4) as $file)
      <a href="{{ $file->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-3 col-sm-6 col-6">
        <img src="{{$file->getFile()}}" class="img-fluid rounded">
      </a>
      @endforeach
    </div>
  </div>
</div>


{{-- Experiences list --}}
<div class="section-content">
  <div class="icon-heading tinny-view">
    <h3>
      <span>More Experiences in </span>{{$experience->experiencePlace->name}}
    </h3>
  </div>
  @php
  $data = $experience->experiencePlace;
  @endphp
  @include('pages.user.trip.partials.experiences.carousel')

</div>
<div class="section-footer border-bottom pb-4 mb-4">
  <button class="btn btn-primary">
    View all
  </button>
</div>
