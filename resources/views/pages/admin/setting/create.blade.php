@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Setting Form')

@section('content')

{{-- {{dd($errors)}} --}}
<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Multiple Column</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          <form method="POST" action="{{ route('admin.user.store') }}">
            @csrf
            @include('pages.admin.user.form')
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
