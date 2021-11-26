@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update Tag')

@section('content')


<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Article Tag Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">

          {!! Form::model($tag, ['route' => ['admin.article.tag.update', $tag->id]]) !!}
          {{ method_field('PATCH') }}
          @include('pages.admin.article.tag.form')
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
