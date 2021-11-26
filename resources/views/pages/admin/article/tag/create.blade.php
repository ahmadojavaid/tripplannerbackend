@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Create Tag')

@section('content')


<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Article Tag Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="POST" action="{{ route('admin.article.tag.store') }}">
            @csrf

          </form>

          {!! Form::open(['url' => route('admin.article.tag.store')]) !!}

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
