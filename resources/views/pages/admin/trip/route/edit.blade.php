@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update Route')

@section('content')

{{-- {{dd($errors)}} --}}
<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Route Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          {!! Form::model($route, ['route' => ['admin.trip.route.update', $route->id] ]) !!}
          {{ method_field('PATCH') }}
          @include('pages.admin.trip.route.form')
          <div class="form-group">
            <button class="btn btn-outline-primary">Store</button>
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('page-script')
<script>
  $(document).ready(function(){
      const destination = @json($route->selected_destination);
      const departure = @json($route->selected_departure);

        handleDestination(destination);
        handleDeparture(departure);

        function handleDestination(data){
          const option = new Option(data.text, data.id, true, true);
          $('.destination-select-2').append(option).trigger('change');
        }

        function handleDeparture(data){

          const option = new Option(data.text, data.id, true, true);
          $('.departure-select-2').append(option).trigger('change');

        }
      })
</script>
@endpush
