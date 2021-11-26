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
          {!! Form::open(['url' => route('admin.trip.route.store') ,'files' => true] ) !!}
          @csrf

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
