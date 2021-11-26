@extends('layouts.user.contentLayoutMaster')
@section('title' , 'Edit Trip Introduction')
@section('content')
<div class="trip-flow-1">
  <input type="hidden" id="date_range_picker_value" value="">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-5 ">
        <div class="page-section">
          <div class="container" id="trip-intro-section">
            <div class="section-head mb-4">
              <h2 class="section-title">
                <span>{{$usertrip->title}}</span> <i class="fa fa-edit" id="edit-intro"></i>
              </h2>
              <p class="section-description">
                {{$usertrip->description}}
              </p>
            </div>
            <div class="section-content mb-4">
              <div class="container">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group date-button">
                      <div class="row">
                        <div class="col-md-8 ">
                          <div class="combine-dates">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <a href="{{route('user.trip.place.update-trip-into',$usertrip->id)}}"><button class="btn-primary btn">
                      Update Introduction
                    </button></a>
                    <button class="btn-primary btn d-inline-block d-lg-none" href="#">
                      <i class="fa fa-map mr-1"></i> Map
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        {{-- Countries Section --}}
        <div class="page-section" id="countries-section">
          <div class="container">
            <div class="section-head mb-3">
              <h2 class="section-title mb-1">
                Change your trip place from here
                <i class="fa fa-edit"></i>
              </h2>
            </div>
          @include('pages.user.trip.create.partials.country_places')
          </div>
        </div>

      </div>
      <div class="col-lg-7 d-none d-md-flex">
        <div class="map-position">
          <div class="map-right" id="trip-map"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Detail Page Element --}}
<div class="trip-custom-flow d-none">

</div>

@include('pages.user.trip.partials.intro_modal')
@endsection




@push('page-script')
<script src={{asset('user/js/trip.js')}}></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
  let data =  {
    country: "{{route('user.trip.country.list')}}",
    places: "{{route('user.trip.place.list')}}",
    place: "{{route('user.trip.place.show')}}",
    add_place: "{{route('user.trip.place.add')}}",
    experience: "{{route('user.trip.experience.show')}}",
    add_experience: "{{route('user.trip.place.add-experience')}}",
    property: "{{route('user.trip.property.show')}}",
    add_property: "{{route('user.trip.place.add-property')}}",
    location:"{{route('user.trip.place.locatons')}}",
    location_popup:"{{route('user.trip.place.locaton.popup')}}",
    location_transport:"{{route('user.trip.place.locaton.transport')}}",
    add_intro:"{{route('user.trip.place.add-trip-into')}}",
    updatelocation:"{{route('user.trip.place.placelocation')}}",
  };
  var userTrip = {!! json_encode($usertrip) !!};
  var dateToday = new Date(userTrip.start_date);
  var start_date = {!! json_encode($start_date) !!};
  var end_date = {!! json_encode($end_date) !!};
  $("#txtDate").datepicker({
    beforeShow: function( input, inst){
      $('.trip-flow-1').css("opacity","0.3");
      $(inst.dpDiv).addClass('modal-date');
    },
    dateFormat: "d MM, yy",
    minDate: dateToday,
    duration: "slow",
    showAnim: 'slideDown',
    onClose: function () {
      $('.trip-flow-1').css("opacity","");
    }
  });
  $("#follow_Date").datepicker({
    beforeShow: function( input, inst){
      $('.trip-flow-1').css("opacity","0.3");
      $(inst.dpDiv).addClass('modal-date');
    },
    dateFormat: "d MM, yy",
    minDate: dateToday,
    duration: "slow",
    showAnim: 'slideDown',
    onClose: function () {
      $('.trip-flow-1').css("opacity","");
    }
  });
  /**function to populate modal values before show**/
  $("#intro-modal").on('shown.bs.modal', function() {
    $("#trip-title").val(userTrip.title);
    $("#trip-description").val(userTrip.description);
  });
  // add class to datepicker modal center
  $(document).ready(function(){
    $("#txtDate").val(start_date);
    $("#follow_Date").val(end_date);
    $('.follow_Date').css('display','')
    initProcess(data);
    $("#country-tabs").addClass("d-none")
    $("#countries-section").addClass("d-none")
  });
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      opens: 'left'
    }, function(start, end, label) {
      console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));

      $('#date_range_picker_value').val(start.format('DD MMMM, YYYY') +' - '+end.format('DD MMMM, YYYY'))
      $('.date-above-place').text($('#date_range_picker_value').val());
      $('.trip-date').text($('#date_range_picker_value').val());
    });
    // $('#txtDate').click();
  });

  $('body').on('click','.save-tripx',function(){
    let loggedIn = {{ auth()->check() ? 'true' : 'false' }};
    $(".panel-default").each(function(){
      var nights = parseInt($(this).find('.no_of_nights') .val())
      var place_id = $(this).find('.handle-transport') .attr('data-id')
      var startDate = $('#txtDate').val()
      var endDate = $('#follow_Date').val()
      $.ajax({
        type: "GET",
        url: "{{route('user.trip.place.add-places-nights')}}",
        data: {
          place_id: place_id, nights:nights,startDate:startDate, endDate:endDate
        },
        success: function(response) {
          if(loggedIn){
            window.location.href = "{{ route('user.trip.create.index')}}";

          }
          else{
            $('#login-modal').modal('show');
          }

        }
      });

    });
  })

  $('body').on('click','.increase-nights',function(){

    var value = parseInt($(this).parents('.item-counter').find('.no_of_nights').val(), 10);
    value = isNaN(value) ? 0 : value;
    value++;
    $(this).parents('.item-counter').find('.no_of_nights').val(value)  ;
    var incDate = document.getElementById('follow_Date').value;
    var newdate = new Date(incDate);

    newdate.setDate(newdate.getDate() + 1);
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var monthNames = [ "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December" ];
    var monthName =  monthNames[newdate.getMonth()];

    // var someFormattedDate = mm + '/' + dd + '/' + y;
    var someFormattedDate = dd+' '+monthName + ', ' + y;

    document.getElementById('follow_Date').value = someFormattedDate;

  })
  $('body').on('click','.decrease-nights',function(){

    var Ovalue = parseInt($(this).parents('.item-counter').find('.no_of_nights').val(), 10);

    value = isNaN(Ovalue) ? 0 : Ovalue;
    value < 3 ? value = 3 : '';
    value--;
    $(this).parents('.item-counter').find('.no_of_nights').val(value) ;

    if (Ovalue > 2) {
      var incDate = document.getElementById('follow_Date').value;
      var newdate = new Date(incDate);

      newdate.setDate(newdate.getDate() - 1);
      var dd = newdate.getDate();
      var mm = newdate.getMonth() + 1;
      var y = newdate.getFullYear();

      var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
      var monthName =  monthNames[newdate.getMonth()];

      // var someFormattedDate = mm + '/' + dd + '/' + y;
      var someFormattedDate = dd+' '+monthName + ', ' + y;
      document.getElementById('follow_Date').value = someFormattedDate;
    }

  })
  // $('#txtDate').on('change',function(){
  //   alert(2233);
  // })
  $('body').on('click','.save-transportation',function(){

    // alert($('input[name=transport_type]:checked').val());
    var str = $('input[name=transport_type]:checked').val();
    var arr = str.split("-");
    var place_id = arr[0]
    var route_id = arr[1]
    var price = arr[2]
    var route_name = arr[3]

    var transp = route_name+' transportation'

    $('.transport-'+place_id).text(transp.charAt(0).toUpperCase() + transp.slice(1))


    $.ajax({
      type: "GET",
      url: "{{route('user.trip.place.add-trip-transport')}}",
      data: {
        place_id: place_id, route_id:route_id,price:price,route_name:route_name
      },
      success: function(response) {
        console.log(response);
      }
    });

  })


  function getdate(){

    var tt = document.getElementById('txtDate').value;

    var date = new Date(tt);
    var newdate = new Date(date);

    var total_no_of_nights = 0;
    $(".no_of_nights").each(function(){
      var nights = parseInt($(this).val())
      total_no_of_nights+=nights;
    });

    // alert(total_no_of_nights);

    newdate.setDate(newdate.getDate() + total_no_of_nights);

    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var monthNames = [ "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December" ];
    var monthName =  monthNames[newdate.getMonth()];

    // var someFormattedDate = mm + '/' + dd + '/' + y;
    var someFormattedDate = dd+' '+monthName + ', ' + y;

    document.getElementById('follow_Date').value = someFormattedDate;
  }
  function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
    var incDate = document.getElementById('follow_Date').value;
    var newdate = new Date(incDate);

    newdate.setDate(newdate.getDate() + 1);
    var dd = newdate.getDate();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var monthNames = [ "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December" ];
    var monthName =  monthNames[newdate.getMonth()];

    // var someFormattedDate = mm + '/' + dd + '/' + y;
    var someFormattedDate = dd+' '+monthName + ', ' + y;

    document.getElementById('follow_Date').value = someFormattedDate;
  }
  function decreaseValue() {
    var Ovalue = parseInt(document.getElementById('number').value, 10);

    value = isNaN(Ovalue) ? 0 : Ovalue;
    value < 3 ? value = 3 : '';
    value--;
    document.getElementById('number').value = value;

    if (Ovalue > 2) {
      var incDate = document.getElementById('follow_Date').value;
      var newdate = new Date(incDate);

      newdate.setDate(newdate.getDate() - 1);
      var dd = newdate.getDate();
      var mm = newdate.getMonth() + 1;
      var y = newdate.getFullYear();

      var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
      var monthName =  monthNames[newdate.getMonth()];

      // var someFormattedDate = mm + '/' + dd + '/' + y;
      var someFormattedDate = dd+' '+monthName + ', ' + y;
      document.getElementById('follow_Date').value = someFormattedDate;
    }
  }

</script>
<link rel="stylesheet" href="{{asset('user/style/video-plugin.css')}}" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
{{--<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">--}}
@endpush
