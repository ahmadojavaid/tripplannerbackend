@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/animate/animate.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/sweetalert2.min.css')) }}">
@endpush

@php
if($scenario == "create"){
$hidden = false;
$disabled= false;
}
else if($scenario == "update"){
$hidden = true;
$disabled= true;
}
@endphp

<div class="form-body">
  <div class="row">
    <div class="col-12">
      {{Form::customSelect('departure_country', ['data' => $countryArr , 'disabled' => $disabled, 'placeholder' => 'Select Country'  , 'id' => 'departure-country'])}}
    </div>
    <div class="col-12">
      {{Form::customSelect('departure',[ 'class' => 'departure-select-2 form-control' ,'disabled' => $disabled , 'placeholder' => 'Select Departure'])}}
    </div>
    <div class="col-12">
      {{Form::customSelect('destination_country', ['data' => $countryArr  , 'disabled' => $disabled,'placeholder' => 'Select Country'  , 'id' => 'destination-country'])}}
    </div>
    <div class="col-12">
      {{Form::customSelect('destination',[ 'class' => 'destination-select-2 form-control' ,'disabled' => $disabled, 'placeholder' => 'Select Destination'])}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('status', $statusArr, null, 'Select Status',[
        ])}}
    </div>
    <div class="col-12">
      {{Form::customField('duration')}}
    </div>
    @if ($hidden)
    <div class="col-12">
      {{-- {{Form::fieldText('price')}} --}}
      {{Form::customField('price' , ['disabled' => $disabled])}}
    </div>
    @endif
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
    const departureCountry  = $('#departure-country');
    const destinationCountry  = $('#destination-country');
    const country  = $('#route-country');
    // const destinationType = $('#destination-type');
    // const departureType = $('#departure-type');



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
            country:departureCountry.children("option:selected").val(),
            type: 4
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
            country:destinationCountry.children("option:selected").val(),
            type: 4
          }
          return query;
        },
        beforeSend:function(xhr ,  opts){
          validateDestination();
        },
      }
    });

    function validateDestination(){
      if(destinationCountry.children("option:selected").val()==="")
      {
        Swal.fire({
          title: "Info!",
          text: "Please select both country",
          type: "info",
          confirmButtonClass: 'btn btn-primary',
          buttonsStyling: false,
        });
        return false;
      }
      return true;
    }

    function validateDeparture(){
      if(departureCountry.children("option:selected").val()==="" )
      {
        Swal.fire({
          title: "Info!",
          text: "Please select both country",
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
