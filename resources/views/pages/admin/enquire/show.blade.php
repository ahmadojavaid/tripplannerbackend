@extends('layouts.admin.contentLayoutMaster')

@section('title',"Enquire Show")

@push('vendor-style')
{{-- vendor files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/datatables.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/extensions/dataTables.checkboxes.css')) }}">
@endpush
@push('page-style')
{{-- Page css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/pages/data-list-view.css')) }}">
@endpush

@section('content')

<div class="card">
  <div class=" card-header">
    <h4 class="card-title">Enquire <small class="text-muted">Details</small></h4>
  </div>
  <div class="card-content">
    <div class="card-body">
      <div class="card-text">
        <dl class="row">
          <dt class="col-sm-3">Range</dt>
          <dd class="col-sm-9">{{$enquire->range}}</dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-3">Adults</dt>
          <dd class="col-sm-9">{{$enquire->adult_count}}</dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-3">Childs</dt>
          <dd class="col-sm-9">{{$enquire->child_count}}</dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-3">Name</dt>
          <dd class="col-sm-9">{{$enquire->first_name}}</dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-3 text-truncate">Email</dt>
          <dd class="col-sm-9">{{$enquire->email}}</dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-3">Description</dt>
          <dd class="col-sm-9">
            {{$enquire->description}}
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-3">Created</dt>
          <dd class="col-sm-9">
            {{$enquire->created_at->diffForHumans()}}
          </dd>
        </dl>
        <dl class="row">
          <dt class="col-sm-3">Last Modified</dt>
          <dd class="col-sm-9">
            {{$enquire->updated_at->diffForHumans()}}
          </dd>
        </dl>
      </div>
    </div>
  </div>
</div>
@endsection
@push('vendor-script')
{{-- vendor js files --}}
<script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.select.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
@endpush
@push('page-script')
{{-- Page js files --}}
<script src="{{ asset(mix('js/scripts/ui/data-list-view.js')) }}"></script>
@endpush
