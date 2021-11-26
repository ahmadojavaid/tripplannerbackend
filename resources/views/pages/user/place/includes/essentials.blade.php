<div class="page-section">
  <div class="section-head">
    <h2 class="section-title">Essentials</h2>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />Why to go there</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['why-to-go-there'])?$essentials['why-to-go-there']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>

  <div id="map"></div>

  <div class="section-content mt-4">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/sun.png')}}" alt="" />How to get there</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['how-to-get-there'])?$essentials['how-to-get-there']:null}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/world.png')}}" alt="" />How to fully enjoy it</h3>
    </div>
    <p class="readmore">
      {{isset($essentials['how-to-fully-enjoy-it']) ?$essentials['how-to-fully-enjoy-it']:null}}
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
    const latitude = "{{$place->latitude}}" ,longitude = "{{$place->longitude}}" ;
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
{{-- 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png --}}
@endpush
