@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Article Tags')

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
{{-- Data list view starts --}}
<section id="data-list-view" class="data-list-view-header">
  <div class="action-container">
    <div class="dt-buttons btn-group">
      <a href="{{route('admin.article.tag.create')}}" class="btn btn-outline-primary" tabindex="0"
        aria-controls="DataTables_Table_0">
        <span> <i class="feather icon-plus"></i> Add New</span>
      </a>
    </div>
  </div>

  {{-- DataTable starts --}}
  <div class="table-responsive">
    <table class="table data-list-view">
      <thead>
        <tr>
          <th></th>
          <th>Name</th>
          <th>Status</th>
          <th>Created</th>
          <th>Last Modified</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($catrgories as $catrgory)
        <tr>
          <td></td>
          <td>{{ $catrgory->name}}</td>
          <td>{{ $catrgory->status }}</td>
          <td>{{ $catrgory->created_at }}</td>
          <td>{{ $catrgory->updated_at }}</td>
          <td class="product-action">
            <a href="{{route('admin.article.tag.edit' , $catrgory->id)}}">
              <span class="action-edit"><i class="feather icon-edit"></i></span>
            </a>
            <span class="action-delete"><i class="feather icon-trash"></i></span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  {{-- DataTable ends --}}

</section>
{{-- Data list view end --}}
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
