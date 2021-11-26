<div class="section-content border-bottom pb-4 mb-4">
  <div class="icon-heading tinny-view">
    <h3>
      <img src="{{asset('user/images/property.png')}}" alt="">
      <span>Your property in </span> {{$property->propertyPlace->name}}
    </h3>
    <button class="right-bottom btn btn-light py-1">Edit</button>
  </div>
  <div class="icon-head-content readmore">
    <span class="readmore-link"></span>
  </div>

  <div class="info-with-images">
    <h3>{{$property->title}}</h3>
    <p>Price: <span>{{$property->price}}$</span> per night, per person</p>
    <div class="row mt-3">
      @foreach ($property->propertyFiles->take(4) as $file)
      <a href="{{ $file->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-3 col-sm-6 col-6">
        <img src="{{$file->getFile()}}" class="img-fluid rounded">
      </a>
      @endforeach
    </div>
  </div>
</div>
