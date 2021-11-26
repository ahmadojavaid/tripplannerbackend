@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Create Article')

@section('content')


<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Article Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          {!! Form::open(['url' => route('admin.article.user.store'),'files' => true]) !!}

          @include('pages.admin.article.user.form')
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
