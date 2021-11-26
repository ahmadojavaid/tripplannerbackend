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
          {!! Form::model($article, ['route' => ['admin.article.user.update', $article->id]]) !!}
          {{ method_field('PATCH') }}
          @include('pages.admin.article.user.form')
          <div class="form-group">
            <button class="btn btn-outline-primary">Store</button>
          </div>
          <img src="{{$article->getFile()}}" alt="article image" class="img-fluid">
          {{-- <img src="{{$article->getFile()}}" alt="article image" class="img-thumbnail"> --}}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
