@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update Article')

@section('content')


<div class="row h-100" id="blog-user-article" article-id="{{$article->id}}">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Article Category Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          {!! Form::model($article, ['route' => ['admin.article.user.update', $article->id] ,'files' => true]) !!}
          {{ method_field('PATCH') }}

          <div class="form-group text-right">
            <button
              class="btn btn-outline-primary">{{auth()->user()->isAdmin() ? __('Publish') : __("Submit")}}</button>
          </div>
          @include('pages.admin.article.user.form')

          <img src="{{$article->getFile()}}" alt="article image" class="img-fluid w-25">
          {!! Form::close() !!}
          @include('pages.admin.article.user.partials.external_hotel')

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
