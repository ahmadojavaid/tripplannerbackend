@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Add Experience')
@section('content')
<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Country Experience Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">

          {!! Form::open(['url' => route('admin.country.experience.store'),'files' => true]) !!}
          @include('pages.admin.country-experience.form')
          <div class="form-group">
            <button class="btn btn-outline-primary handle-basic-information">Store</button>
          </div>

          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
