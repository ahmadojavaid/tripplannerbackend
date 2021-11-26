@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Create Property')

@section('content')

<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Property Form</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          @include('pages.admin.property.form')
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
