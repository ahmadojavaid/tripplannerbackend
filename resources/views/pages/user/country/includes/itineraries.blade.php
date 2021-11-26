<div class="section-content">
  <div class="section-head">
    <h2 class="section-title mb-4">Itineraries in {{$country->name}}</h2>
    <p class="mb-4">
      Comming Soon
    </p>
  </div>
  <div class="section-content">
    <div class="trips-owl with-three large-img owl-carousel">
      @foreach ($country->countryItineraries as $item)
      <div>
        <div class="trip-highlight-card">
          <div class="card-head">
            <img src="{{$item->getFile()}}" alt="">
            <div class="map">
              <img src="{{asset('user/images/map-1.png')}}" alt="" class="pr-0">
              {{-- <div style="width:100%;height:100%;" id="map-{{$item->id}}" class="google-map"
              data-lat="{{$item->latitude}}" data-lng="{{$item->longitude}}" data-title="{{$item->title}}"></div> --}}
          </div>
        </div>
        <div class="card-content">
          <h3>{{$item->title}}</h3>
          <p>
            {{$item->description}}
          </p>
        </div>
      </div>
    </div>

    @endforeach
  </div>
</div>
<div class="section-footer mt-3 mb-5">
  <button class="btn-primary btn mr-lg-3 mr-2" href="#">View all highlighted trips</button>
  <button class="btn-secondary btn" href="#">Create your own</button>
</div>
</div>

@push('page-script')
<script>
  function myMap() {
    var map = $('.google-map');
    map.each(function(){
      var self = $(this);
      const myLatLng = {
        lat: parseInt(self.attr('data-lat')),
        lng: parseInt(self.attr('data-lng'))
      };
      const map = new google.maps.Map(self.get(0), {
        zoom: 5,
        center: myLatLng
      });
      new google.maps.Marker({
        position: myLatLng,
        map,
        title: self.attr('data-title')
      });
    });
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGe7y-eFxi7AJhQSN5-6BXPW97ocMb5Ow&callback=myMap">
</script>
@endpush
