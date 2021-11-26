@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endpush
<div class="basic-information-container">
  @if(isset($property))
  {!! Form::model($property, ['route' => ['admin.property.update', $property->id]]) !!}
  {{ method_field('PATCH') }}

  @else
  {!! Form::open(['url' => route('admin.property.store')]) !!}
  @endif
  <div class="row">
    <div class="col-12">
      {{Form::fieldText('title')}}
    </div>
    <div class="col-6">
      {{Form::fieldText('price')}}
    </div>
    <div class="w-100"></div>
    <div class="col-6">
      {{Form::customSelect('type',['data' =>$typeArr, 'placeholder' => 'Select Type', 'class' => 'type-select2 form-control'])}}
    </div>
    <div class="w-100"></div>
    <div class="col-6">
      {{Form::customSelect('place',['data' =>$placeArr,'placeholder' =>'Select Place'])}}
    </div>
    <div class="col-6">
      {{Form::customSelect('categories[]',['data' =>$categoryArr, 'placeholder' => false, 'label'=>'Categories', 'class' => 'category-select2 form-control' ,'multiple' => true])}}
    </div>
    <div class="col-6">
      {{Form::fieldSelect('status',$statusArr)}}
    </div>
    <div class="col-6">
      {{Form::fieldSelect('priority',$priorityArr)}}
    </div>
    <div class="col-6">
      {{Form::fieldText('latitude')}}
    </div>
    <div class="col-6">
      {{Form::fieldText('longitude')}}
    </div>
    <div class="col-12">
      {{Form::fieldTextarea('short_description')}}
    </div>
  </div>
  <div class="form-group">
    <button class="btn btn-outline-primary handle-basic-information">Store</button>
  </div>
  {!! Form::close() !!}
</div>
@push('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endpush
@push('page-script')
<script>
  $(document).ready(function(){


    $('.category-select2').select2({
      dropdownAutoWidth: true,
      placeholder : "Select Categories",
    });
  });
</script>
@endpush
