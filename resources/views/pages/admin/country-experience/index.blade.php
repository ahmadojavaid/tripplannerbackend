@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Country Experience Manager')

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
      <a href="{{route('admin.country.experience.create')}}" class="btn btn-outline-primary">
        <span> <i class=" feather icon-plus"></i> Add New</span>
      </a>
    </div>
  </div>

  {{-- DataTable starts --}}
  <div class="table-responsive">
    <table class="table data-list-view">
      <thead>
        <tr>
          <th></th>
          <th>Title</th>
          <th>Slug</th>
          <th>Country</th>
          <th>Created By</th>
          <th>Status</th>
          <th>Last Modfied</th>
          <th>ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($experiences as $experience)
        @php
        $status = $experience->translateStatus();

        @endphp
        <tr>
          <td></td>
          <td>{{ $experience->title}}</td>
          <td>{{ $experience->slug}}</td>
          <td>{{ $experience->country_name}}</td>
          {<td>{{ $experience->owner}}</td>
          <td><span class="{{$status['color']}}">{{$status['label']}}</span></td>
          <td>{{ $experience->updated_at }}</td>
          <td class="product-action">
            <a href="{{route('admin.country.experience.edit',$experience->id)}}">
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
