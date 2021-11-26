@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update Trip')

@section('content')

{{-- {{dd($errors)}} --}}
<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Trip Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          {!! Form::model($trip, ['route' => ['admin.trip.update', $trip->id] ,'files' => true]) !!}
          {{ method_field('PATCH') }}
          @include('pages.admin.trip.form')
          <div class="form-group">
            <button class="btn btn-outline-primary">Store</button>
          </div>
          <img src="{{$trip->getFile()}}" id="display-image" alt="trip image" class="img-fluid">
          <img src="{{$trip->getRouteMapsFile()}}" id="display-image" alt="trip image" class="img-fluid">

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@include('pages.admin.trip.partials.croppie')
@endsection
@push('page-script')

<script>
  $(document).ready(function(){

        const middleLocations = @json($trip->middle_locations);
        const firstLocation = @json($trip->start_location);
        const lastLocation = @json($trip->end_location);
        handleRoute(middleLocations);
        handleFirstLocation(firstLocation);
        handleLastLocation(lastLocation);

        function handleFirstLocation(location){
          const option = new Option(location.text, location.id, true, true);
          $('.starting-place').append(option).trigger('change');
        }


        function handleLastLocation(location){
          const option = new Option(location.text, location.id, true, true);
          $('.ending-place').append(option).trigger('change');
        }


        function handleRoute(locations){
            locations.forEach(route => {
              const option = new Option(route.text, route.id, true, true);
              $('.route-select-2').append(option);
              //
            });
            $('.route-select-2').trigger('change');
        }
      });
</script>
@endpush
