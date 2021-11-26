<div class="owl-carousel country-owl owl-theme mb-3">
  @foreach ($experience->experienceFiles as $item)
  <div class="item">
    <img src="{{$item->getFile()}}" alt="carousel country image" class="main-banner-img" />
  </div>
  @endforeach
</div>
