@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Enquire Manager')

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
  {{-- <div class="action-container">

    <div class="dt-buttons btn-group">
      <a href="{{route('admin.country.create')}}" class="btn btn-outline-primary">
  <span> <i class=" feather icon-plus"></i> Add New</span>
  </a>
  </div>
  </div> --}}

  {{-- DataTable starts --}}
  <div class="table-responsive">
    <table class="table data-list-view">
      <thead>
        <tr>
          <th></th>
          <th>Range</th>
          {{-- <th>Status</th> --}}
          {{-- <th>Priority</th> --}}
          <th>Email</th>
          <th>Creaed by</th>
          <th>Created</th>
          <th>Last Modfied</th>
          <th>ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($enquires as $enquire)
        @php
        // $status = $country->translateStatus();
        // $priority = $country->translatePriorityStatus();

        @endphp
        <tr>
          <td></td>
          <td>{{ $enquire->range}}</td>
          {{-- <td>{{$enquire->status}}</td> --}}
          {{-- <td><span class="{{$status['color']}}">{{$status['label']}}</span></td> --}}
          <td>{{$enquire->email}}</td>
          <td>{{$enquire->first_name}}</td>
          <td>{{ $enquire->created_at }}</td>
          <td>{{ $enquire->updated_at }}</td>
          <td class="product-action">
            <a href="{{route('admin.enquire.show',$enquire->id)}}">
              <span class="action-show"><i class="feather icon-eye"></i></span>
            </a>
            {{-- <span class="action-delete"><i class="feather icon-trash"></i></span> --}}
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
