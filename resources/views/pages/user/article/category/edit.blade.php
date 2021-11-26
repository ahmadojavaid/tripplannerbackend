@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Form Layouts')

@section('content')


<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Article Category Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">

          {!! Form::model($category, ['route' => ['admin.article.category.update', $category->id]]) !!}
          {{ method_field('PATCH') }}
          @include('pages.admin.article.category.form')
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
