@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Country Manager')

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

{{-- {{dd(request()->session())}} --}}

{{-- Data list view starts --}}
<section id="data-list-view" class="data-list-view-header">
  <div class="action-container">

    <div class="dt-buttons btn-group">
      <a href="{{route('admin.country.create')}}" class="btn btn-outline-primary">
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
          <th>Name</th>
          <th>Status</th>
          <th>Priority</th>
          <th>Created</th>
          <th>Last Modfied</th>
          <th>ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($countries as $country)
        @php
        $status = $country->translateStatus();
        $priority = $country->translatePriorityStatus();

        @endphp
        <tr>
          <td></td>
          <td>{{ $country->name}}</td>
          <td><span class="{{$status['color']}}">{{$status['label']}}</span></td>
          <td><span class="{{$priority['color']}}">{{$priority['label']}}</span></td>
          <td>{{ $country->created_at }}</td>
          <td>{{ $country->updated_at }}</td>
          <td class="product-action">
            <div class="flex justify-content-between">
            <a href="{{route('admin.country.edit',$country->id)}}">
              <span class="action-edit"><i class="feather icon-edit"></i></span>
            </a>
            <form action="{{ route('admin.country.delete', $country->id) }}" method="post">
             <button> <i class="feather icon-trash"></i></button>
              <input type="hidden" name="_method" value="delete" />
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
            </div>
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
