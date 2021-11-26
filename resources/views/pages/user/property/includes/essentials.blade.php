<div class="page-section" id="inpiration-scroll">
  <div class="section-head">
    <h2 class="section-title">Essentials</h2>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />Why this property is special</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['why-this-property-is-special'])?$essentials['why-this-property-is-special']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div id="map"></div>

  <div class="section-content mt-4">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />Rooms</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['rooms'])?$essentials['rooms']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />Experiences</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['experiences'])?$essentials['experiences']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />Cuisine</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['cuisine'])?$essentials['cuisine']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />What's included</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['what\'s-included'])?$essentials["what's-included"]:null}}
      <span class="readmore-link"></span>
    </p>
  </div>

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
    const latitude = "{{$property->latitude}}" ,longitude = "{{$property->longitude}}" ;
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
