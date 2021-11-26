@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Update User')

@section('content')

{{-- {{dd($errors)}} --}}
<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">User Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">

          {!! Form::model($user, ['route' => ['admin.user.update', $user->id]]) !!}
          {{ method_field('PATCH') }}
          @include('pages.admin.user.form')
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
