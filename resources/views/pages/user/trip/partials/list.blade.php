@forelse ($data as $trip)
<div class="media border-bottom pb-4 mb-5">
  <div class="trip-highlight-card">
    <div class="card-head">
      <img src="{{asset('user/images/trip-card-img.png')}}" alt="" />
      <div class="map">
        <img class="pr-0 rounded" src="{{asset('user/images/map-1.png')}}" alt="">
      </div>
    </div>
  </div>
  <div class="media-body">
    <h5 class="mt-0">
      {{$trip->title}}
      @include('pages.user.trip.partials.favourite')
    </h5>
    <p>
      {{$trip->description}}
    </p>
    <div class="media-btn">
      <button class="btn btn-primary mr-3">
        View Trip
      </button>
      <button class="btn btn-secondary">
        Enquire
      </button>
    </div>
  </div>
</div>
@empty
<div class="col-md-12">
  <p>{{__("No Trip Found")}}</p>
</div>
@endforelse
{{ $data->links('components.user.pagination.custom') }}
