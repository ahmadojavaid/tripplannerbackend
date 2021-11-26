<div class="row">
  <div class="col">
    <div class="media border-bottom pb-4 mb-5">
      <div class="trip-highlight-card">
        <div class="card-head">
          <img src="{{asset('user/images/trip-card-img.png')}}" alt="" />
          <div class="map" id="map-1" style="height:200px;"></div>
        </div>
      </div>
      <div class="media-body">
        <h5 class="mt-0">
          <p>Media heading</p>
          <button class="btn btn-light">Delete</button>
        </h5>
        <p>
          Cras sit amet nibh libero, in gravida nulla. Nulla
          vel metus scelerisque ante sollicitudin. Cras
          purus odio, vestibulum in vulputate at, tempus
          viverra turpis. Fusce condimentum nunc ac nisi
          vulputate fringilla. Donec lacinia congue felis in
          faucibus.
        </p>
        <div class="media-btn">
          <button class="btn btn-primary mr-3">
            View Trip
          </button>
          <button class="btn btn-secondary">Enquire</button>
        </div>
      </div>
    </div>
    <div class="media border-bottom pb-4 mb-5">
      <div class="trip-highlight-card">
        <div class="card-head">
          <img src="{{asset('user/images/trip-card-img.png')}}" alt="" />
          <div class="map" id="map-2"></div>
        </div>
      </div>
      <div class="media-body">
        <h5 class="mt-0">
          <p>Media heading</p>
          <button class="btn btn-light">Delete</button>
        </h5>
        <p>
          Cras sit amet nibh libero, in gravida nulla. Nulla
          vel metus scelerisque ante sollicitudin. Cras
          purus odio, vestibulum in vulputate at, tempus
          viverra turpis. Fusce condimentum nunc ac nisi
          vulputate fringilla. Donec lacinia congue felis in
          faucibus.
        </p>
        <div class="media-btn">
          <button class="btn btn-primary mr-3">
            View Trip
          </button>
          <button class="btn btn-secondary">Enquire</button>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- <div class="map" id="map"></div>
@push('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>
<script src="{{asset('leaflet/leaflet.polylineDecorator.js')}}"></script>
<script src="{{asset('leaflet/example.js')}}"></script>
<script>
  // $(document).ready(function(){

    init();
  // });
</script>
@endpush
@push('page-script')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />
@endpush --}}
