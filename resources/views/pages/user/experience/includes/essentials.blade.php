<div class="page-section" id="inpiration-scroll">
  <div class="section-head">
    <h2 class="section-title">Essentials</h2>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />Recommended For</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['recommended-for'])?$essentials['recommended-for']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div id="map"></div>

  <div class="section-content mt-4">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/sun.png')}}" alt="" />Why this Experience</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['why-this-experience'])?$essentials['why-this-experience']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/world.png')}}" alt="" />what you can expect</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['what-you-can-expect']) ?$essentials['what-you-can-expect']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/world.png')}}" alt="" />What's included</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['what\'s-included']) ?$essentials['what\'s-included']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>

  @if (isset($essentials['what\'s-not-included']) && $essentials['what\'s-not-included'] != "" )


  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/world.png')}}" alt="" />What's not included</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['what\'s-included']) ?$essentials['what\'s-not-included']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  @endif
</div>

@push('page-script')

<style>
  #map {
    width: 100%;
    height: 400px;
  }
</style>
<script>
  $(document).ready(function(){
    const latitude = "{{$experience->latitude}}" ,longitude = "{{$experience->longitude}}" ;
    var map = L.map('map',{attributionControl: false ,zoomControl: false}).setView([latitude ,longitude], 5);
    L.control.zoom({ position: 'bottomright' }).addTo(map);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // attribution: false
    }).addTo(map);



    L.marker([latitude , longitude]).addTo(map);
        // .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        // .openPopup();
  });
</script>

@endpush
