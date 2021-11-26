@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endpush
<div class="basic-information-container">
  {!! Form::open(['url' => route('admin.property.external.store')]) !!}
  <div class="row">
    <div class="col-6">
      {{Form::customSelect('city',['data' =>$cityArr, 'placeholder' => 'Select City','id' => 'select-2-city', 'class' => 'property-select2 form-control'])}}
    </div>

    <div class="col-6">
      {{Form::customSelect('external_id',[ 'placeholder' => 'Select Hotel', 'label' => 'Hotel', 'class' => 'hotel-select-2 form-control'])}}
    </div>

    <div class="col-6">
      {{Form::fieldSelect('status',$statusArr)}}
    </div>
    <div class="col-6">
      {{Form::fieldSelect('priority',$priorityArr)}}
    </div>

    <div class="col-6">
      {{Form::customSelect('type',['data' =>$typeArr,  'placeholder' => 'Select Type', 'class' => 'property-select2 form-control'])}}

    </div>
    <div class="col-6">

      {{Form::customSelect('categories[]',['data' =>$categoryArr, 'label'=>'Categories', 'select2' =>['data-placeholder' =>'Select Category'  , 'data-multiple' =>1, ], 'placeholder'=> false ,'multiple'=>true,  'class' => 'property-select2 form-control'])}}
    </div>

  </div>
  <div class="form-group">
    <button class="btn btn-outline-primary handle-basic-information">Store</button>
  </div>
  {!! Form::close() !!}
</div>
@push('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/polyfill.min.js')) }}"></script>

@endpush
@push('page-script')
<script src="{{ asset(mix('js/scripts/extensions/sweet-alerts.js')) }}"></script>

<script>
  $(document).ready(function(params) {


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    //select2
    const lcoationsRoute = "{{route('admin.property.external.list')}}";
    const place = $('#select-2-city');
    $('.property-select2').select2();



    $('.hotel-select-2').select2({
      dropdownAutoWidth: true,
      placeholder : "Select Hotel",
      // hiding search bar
      minimumResultsForSearch: -1,
      ajax: {
        url: lcoationsRoute,
        type: "POST",
        dataType: "json",
        delay: 250,
        data: function (params) {
          var query = {
            city: place.children("option:selected").val()
          }
          return query;
        },
        beforeSend:function(xhr ,  opts){
          validatePlace();
        },
      }
    });



    function validatePlace(){
      if(place.children("option:selected").val()==="")
      {
        Swal.fire({
          title: "Info!",
          text: "Please select City",
          type: "info",
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        });
        return false;
      }
      return true;
    }

  });
</script>
@endpush
