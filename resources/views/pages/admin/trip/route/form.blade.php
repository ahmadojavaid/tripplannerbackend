@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">

@endpush

<div class="form-body">
  <div class="row">
    <div class="col-12">
      {{Form::customSelect('country', ['data' => $countryArr , 'placeholder' => 'Select Country'  , 'id' => 'route-country'])}}
    </div>

    <div class="col-12">
      {{Form::customSelect('departure_type',['data' =>$typeArr,'placeholder'=> 'Select Departure Type' , 'id' => 'departure-type'  , 'label'=>'Departure Type'])}}
    </div>
    <div class="col-12">
      {{Form::customSelect('departure',[ 'class' => 'departure-select-2 form-control' , 'placeholder' => 'Select Departure'])}}
    </div>
    <div class="col-12">
      {{Form::customSelect('destination_type',['data' =>$typeArr,'placeholder'=> 'Select Destination Type' , 'id' => 'destination-type' ,'label'=>'Destination Type'])}}
    </div>
    <div class="col-12">
      {{Form::customSelect('destination',[ 'class' => 'destination-select-2 form-control' , 'placeholder' => 'Select Destination'])}}
    </div>
    <div class="col-12">
      {{Form::customSelect('transport_type',['data' => $transportArr,'placeholder'=>'Select Transport','label'=> 'Transport Type' ])}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('status', $statusArr, null, 'Select Status',[
        ])}}
    </div>
    <div class="col-12">
      {{Form::customField('duration')}}
    </div>
    <div class="col-12">
      {{Form::fieldText('price')}}
    </div>
  </div>
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
    const lcoationsRoute = "{{route('admin.trip.route.locations')}}";
    const country  = $('#route-country');
    const destinationType = $('#destination-type');
    const departureType = $('#departure-type');



    $('.departure-select-2').select2({
      dropdownAutoWidth: true,
      placeholder : "Select Departure",
      minimumInputLength:-1,
      ajax: {
        url: lcoationsRoute,
        type: "POST",
        dataType: "json",
        delay: 250,
        data: function (params) {
          var query = {
            search: params.term,
            country:country.children("option:selected").val(),
            type: departureType.children("option:selected").val()
          }
          return query;
        },
        beforeSend:function(xhr ,  opts){
          validateDeparture();
        },
      }
    });

    $('.destination-select-2').select2({
      dropdownAutoWidth: true,
      placeholder : "Select Destination",
      minimumInputLength:-1,
      ajax: {
        url: lcoationsRoute,
        type: "POST",
        dataType: "json",
        delay: 250,
        data: function (params) {
          var query = {
            search: params.term,
            country:country.children("option:selected").val(),
            type: destinationType.children("option:selected").val()
          }
          return query;
        },
        beforeSend:function(xhr ,  opts){
          validateDestination();
        },
      }
    });

    function validateDestination(){
      if(country.children("option:selected").val()==="" || destinationType.children("option:selected").val()==="" )
      {
        Swal.fire({
          title: "Info!",
          text: "Please select both country and destination type",
          type: "info",
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        });
        return false;
      }
      return true;
    }

    function validateDeparture(){
      if(country.children("option:selected").val()==="" || departureType.children("option:selected").val()==="" )
      {
        Swal.fire({
          title: "Info!",
          text: "Please select both country and departure type",
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
