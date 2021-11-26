@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update Country')

@section('content')

<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Country Itinerary Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          {!! Form::model($itinerary, ['route' => ['admin.country.itinerary.update', $itinerary->id], 'files' => true])
          !!}
          {{ method_field('PATCH') }}

          @include('pages.admin.country-itinerary.form')
          <div class="form-group">
            <button class="btn btn-outline-primary handle-basic-information">Store</button>
          </div>
          {!! Form::close() !!}
          <img src="{{$itinerary->getFile()}}" alt="article image" class="img-fluid">

        </div>
      </div>
    </div>
  </div>
</div>


@endsection
