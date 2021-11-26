@extends('layouts.admin.contentLayoutMaster')

@section('title', 'Trip Route Manager')

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
      <a href="{{route('admin.trip.route.create')}}" class="btn btn-outline-primary" tabindex="0"
        aria-controls="DataTables_Table_0">
        <span> <i class="feather icon-plus"></i> Add New</span>
      </a>
      <a href="{{route('admin.trip.route.airport.create')}}" class="btn btn-outline-primary" tabindex="0"
        aria-controls="DataTables_Table_0">
        <span> <i class="feather icon-plus"></i> Add External</span>
      </a>
    </div>
  </div>

  {{-- DataTable starts --}}
  <div class="table-responsive">
    <table class="table data-list-view">
      <thead>
        <tr>
          <th></th>
          <th>Departure Country</th>
          <th>Departure Type</th>
          <th>Departure</th>
          <th>Destination Country</th>
          <th>Destination Type</th>
          <th>Destination</th>
          <th>Status</th>
          <th>Last Modified</th>
          <th>ACTION</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($routes as $route)
        @php
        $status = $route->translateStatus();
        @endphp
        <tr>
          <td></td>
          <td class="product-name">{{ $route->departure_country_name}}</td>
          <td class="product-category">{{ $route->translateType($route->departure_type) }}</td>
          <td class="product-category">{{ $route->departure_name }}</td>
          <td class="product-category">{{ $route->destination_country_name }}</td>
          <td class="product-category">{{ $route->translateType($route->destination_type) }}</td>
          <td class="product-category">{{ $route->destination_name }}</td>
          <td><span class="{{$status['color']}}"> {{$status['label']}}</span> </td>
          <td class="product-category">{{ $route->updated_at }}</td>
          <td class="product-action">
            @php
            $editRoute = 'admin.trip.route.edit';
            if($route->departure_type == 4)
            $editRoute = 'admin.trip.route.airport.edit';

            @endphp
            <a href="{{route($editRoute,$route->id)}}">
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
