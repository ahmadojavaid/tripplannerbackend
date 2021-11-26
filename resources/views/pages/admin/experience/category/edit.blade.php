@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update Place')

@section('content')
<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Place Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          {!! Form::model($category, ['route' => ['admin.experience.category.update', $category->id]]) !!}
          {{ method_field('PATCH') }}

          @include('pages.admin.experience.category.form')
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
