<div class="page-section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">
        The Route Makers - Explore and create your own trip to South America; we will work out the details.
      </h2>
      <p class="section-description">
        You can become a travel artist and write your own travel story. We give you all the possible routes and the most recommended experiences and properties within each destination.
      </p>
    </div>
    <div class="section-content">
      <div class="trips-owl large-img owl-carousel">
        @forelse ($trips as $trip)
        <a href="{{route('user.trip.show',$trip->id)}}">
          <div class="trip-highlight-card">
            <div class="card-head">
              <img src="{{$trip->getFile()}}" alt="" />
              <div class="map">
                <img class="pr-0 rounded" src="{{$trip->getRouteMapsFile()}}" alt="{{asset('user/images/map-1.png')}}">
              </div>
            </div>
            <div class="card-content">
              <h3 class="max-2-line">{{$trip->title}}</h3>
              <p class="max-4-line">
                {{$trip->description}}
              </p>
            </div>
          </div>
        </a>
        @empty
        <p>No Trip Found</p>
        @endforelse

      </div>

    </div>
    <div class="section-footer border-b">
      @if ($trips->first())
      <a class="btn-primary btn" href="{{route('user.trip.index')}}">
        View all highlighted trips
      </a>
      @endif
    </div>
  </div>
</div>
