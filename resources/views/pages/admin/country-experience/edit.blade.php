@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update Place')

@section('content')

<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Country Place Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          {!! Form::model($experience, ['route' => ['admin.country.experience.update', $experience->id], 'files' =>
          true])
          !!}
          {{ method_field('PATCH') }}

          @include('pages.admin.country-experience.form')
          <div class="form-group">
            <button class="btn btn-outline-primary handle-basic-information">Store</button>
          </div>
          {!! Form::close() !!}
          <img src="{{$experience->getFile()}}" alt="article image" class="img-fluid">

        </div>
      </div>
    </div>
  </div>
</div>


@endsection
