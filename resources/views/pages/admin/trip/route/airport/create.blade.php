@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Create Trip Route')

@section('content')

<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Route Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          @if ($message = Session::get('no-data'))
          <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
          @endif

          {!! Form::open(['url' => route('admin.trip.route.airport.store')] ) !!}
          @csrf

          @include('pages.admin.trip.route.airport.form' , [
          'scenario' => 'create'
          ])
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
