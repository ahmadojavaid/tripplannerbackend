@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endpush
<div class="form-body">
  <span class="row">
    <div class="col-12">
      {{Form::fieldText('title')}}
    </div>
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
      {{Form::label('start_date', 'Start date')}}
      {{Form::date('start_date')}}
    </div>
    <div class="form-group col-xs-10 col-sm-4 col-md-4 col-lg-6">
      {{Form::label('end_date', 'End date')}}
      {{Form::date('end_date')}}
    </div>
    <div class="col-12">
      {{Form::fieldTextarea('description')}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('status', $statusArr, null, 'Select Status',[
        ])}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('priority', $priorityArr, null, 'Select Priority',[
        ])}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('category', $categoryArr, null, 'Select Category',[
        ])}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('country', $countriesArr, null, 'Select Country',[
        ])}}
    </div>
          {{--      ------------------------}}
    <input type="hidden" id="places_count" name="places_count" value="0">
    <div class="col-12 append-elements">

      <div class="place_div">

        <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select id="places" name="places0" class="form-control places" >
                              <option value="">Select place</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="from-group">
                            <input id="no_of_nights" name="no_of_nights0"   type="text" class="form-control no_of_nights" placeholder="No of nights">
                        </div>
                    </div>
                </div>
        <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="experiences0[]" class="form-control js-example-basic-multiple experiences js-example-basic-multiple" multiple="multiple">
                              <option disabled value="">Select experience</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="properties0[]" class="form-control properties js-example-basic-multiple" multiple="multiple">
                                <option disabled value="">Select property</option>
                          </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select id="transport" name="transport0" class="form-control transport" >
                              <option selected="selected" value="">Select Transport</option>
                              <option value="Flight">Flight</option>
                              <option value="Private">Private</option>
                              <option value="Self Drive">Self Drive</option>
                              <option value="Own Arrange">Own Arrange</option>
                              <option value="Private transportation with english speaking guide">Private transportation with english speaking guide</option>
                              <option value="Train">Train</option>
                              <option value="Bus">Bus</option>
                              <option value="Airport">Airport</option>
                            </select>
                        </div>
                    </div>
                </div>
      </div>

{{--      -----------------------------}}
{{--    <div class="col-12">--}}
{{--      {{Form::customSelect('startingPlace' ,['data' => [] , 'class' => 'starting-place form-control' , 'label' => 'Starting Place' ] )}}--}}
{{--    </div>--}}
{{--    <div class="col-12">--}}
{{--      {{Form::customSelect('places[]' ,['data' =>[] , 'class' => 'route-select-2 form-control' , 'label' => 'Routes' , 'multiple' =>true ] )}}--}}
{{--    </div>--}}

{{--    <div class="col-12">--}}
{{--      {{Form::customSelect('endingPlace' ,['data' => [] , 'class' => 'ending-place form-control' , 'label' => 'Ending Place' ] )}}--}}
{{--    </div>--}}
    </div>
    <div class="col-12">
      <a class="add-place btn-sm btn-primary" style="float: right;color: white;margin-bottom: 4px;">Add Place</a>
    </div>
    <div class="col-12">
      {{Form::fieldText('price')}}
    </div>
    <div class="col-12">
      <input type="hidden" name="photo" id="photo">
    </div>
    <div class="col-12">
      {{Form::fieldFile('uploader',null, 'Featured Image')}}
    </div>
    <div class="col-12" >
      <input type="hidden" name="route_map_photo" id="route_map_photo" >
    </div >
    <div class="col-12" >
      {{Form::fieldFile('route_photo_uploader',null, 'Route Image')}}
    </div >
  </div>
</div>
@include('pages.admin.trip.partials.croppie')
@include('pages.admin.trip.partials.route-map-croppie')
@push('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endpush
@push('page-script')
<script>
  $(document).ready(function(params) {
    initCroppieJs();
    function initCroppieJs(){
        let rawImg ='';
        const image_crop = $('#image_demo').croppie({
            viewport: {
                width: 200,
                height: 275,
            },
            boundary:{
                width:"100%",
                height:400
            },
            enableExif: true
        });


      function profileImage(input) {
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {

              $('#profile-image-modal').modal('show');
              rawImg = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $('#profile-image-modal').on('shown.bs.modal', function(){
          image_crop.croppie('bind', {
              url: rawImg
          }).then(function(){
              console.log('jQuery bind complete');
          });
      });


      $('#uploader').on('change',function() {
       profileImage(this);
      });

      $('.crop_image').click(function(event){
        image_crop.croppie('result', {
            type: 'canvas',
            size: 'viewport',

        }).then(function(response){
            $('#display-image').attr('src', response);
            $('input#photo:hidden').val(response);
            $('#profile-image-modal').modal('hide');
        });
      });

      //-------------------------------------------------------

      let rawImgx ='';
      const route_map_image_crop = $('#image_demo_route_map').croppie({
        viewport: {
          width: 200,
          height: 275,
        },
        boundary:{
          width:"100%",
          height:400
        },
        enableExif: true
      });


      function routeMapImage(input) {
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function (e) {

            $('#profile-image-modal-route-map').modal('show');
            rawImgx = e.target.result;
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $('#profile-image-modal-route-map').on('shown.bs.modal', function(){
        route_map_image_crop.croppie('bind', {
          url: rawImgx
        }).then(function(){
          console.log('jQuery bind complete');
        });
      });

      $('#route_photo_uploader').on('change',function() {
        routeMapImage(this);
      });

      $('.crop_image_route_map').click(function(event){
        route_map_image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport',

        }).then(function(response){
          $('#display-image').attr('src', response);
          $('input#route_map_photo:hidden').val(response+'364ed3');
          $('#profile-image-modal-route-map').modal('hide');
        });
      });

    }


    //select2
    const placesRoutes = "{{route('admin.trip.country.places')}}";
    const country  = $('#country');
    $('.route-select-2').select2({
      dropdownAutoWidth: true,
      placeholder : "Select Routes",
      minimumInputLength: 1,
      ajax: {
        url: placesRoutes,
        data: function (params) {
          var query = {
            search: params.term,
            country:country.children("option:selected").val()
          }
          return query;
        },
      }
    });


    $('.starting-place , .ending-place').select2({
      dropdownAutoWidth: true,
      placeholder : "Select Routes",
      minimumInputLength: 1,
      ajax: {
        url: placesRoutes,
        data: function (params) {
          var query = {
            search: params.term,
            country:country.children("option:selected").val()
          }
          return query;
        },
      }
    });

    $(document).on('change' , '#country' ,  function(){
      $('.route-select-2 option').remove();
      $('.starting-place option').remove();
      $('.ending-place option').remove();
    });

    var index = 0;
    $(".add-place").click(function(){
      index++;
      $('#places_count').val(index);
      // $(".place_div").clone().appendTo(".append-elements");

      // var data = $('.place_div').clone();
      var data = '<div class="place_div">\n' +
        '        <div class="row">\n' +
        '                    <div class="col-6">\n' +
        '                        <div class="form-group">\n' +
        '                            <select id="places'+index+'" name="places'+index+'" class="form-control places" >\n' +
        '                              <option value="">Select place</option>\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-6">\n' +
        '                        <div class="from-group">\n' +
        '                            <input id="no_of_nights'+index+'" name="no_of_nights'+index+'"   type="text" class="form-control no_of_nights" placeholder="No of nights">\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '        <div class="row">\n' +
        '                    <div class="col-6">\n' +
        '                        <div class="form-group">\n' +
        '                            <select id="experiences'+index+'" name="experiences'+index+'[]" class="form-control js-example-basic-multiple experiences js-example-basic-multiple" multiple="multiple">\n' +
        '                              <option disabled value="">Select experience</option>\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-6">\n' +
        '                        <div class="form-group">\n' +
        '                            <select id="properties'+index+'" name="properties'+index+'[]" class="form-control properties js-example-basic-multiple" multiple="multiple">\n' +
        '                                <option disabled value="">Select property</option>\n' +
        '                          </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                    <div class="col-6">\n' +
        '                        <div class="form-group">\n' +
        '                            <select id="transport'+index+'" name="transport'+index+'" class="form-control transport" >\n' +
        '<option selected="selected" value="">Select Transport</option>\n' +
      '<option value="Flight">Flight</option>\n' +
      '<option value="Private">Private</option>\n' +
      '<option value="Self Drive">Self Drive</option>\n' +
      '<option value="Own Arrange">Own Arrange</option>\n' +
      '<option value="Private transportation with english speaking guide">Private transportation with english speaking guide</option>\n' +
      '<option value="Train">Train</option>\n' +
      '<option value="Bus">Bus</option>\n' +
      '<option value="Airport">Airport</option>\n' +
        '                            </select>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '      </div>';

      $('.append-elements').append(data);
      $('.js-example-basic-multiple').select2();

      if($('#country').val())
      {
        $.ajax({
          type:"GET",
          url:'{{route('admin.trip.get-cities')}}',
          data:{id:$('#country').val()},//only input
          success: function(response,status){
            debugger

            var json_response = JSON.parse(response);

            if (json_response.data=='false'){
              $('#places'+index).empty();

              var cities =[];
              cities = json_response.data;
              $('#places'+index).append($("<option></option>").val(0).html('Select place'));
            }
            else {
              $('#places'+index).empty();

              var cities =[];
              cities = json_response.data;
              $('#places'+index).append($("<option></option>").val(0).html('Select place'));

              $.each(cities , function (key,datax){
                $('#places'+index).append($("<option></option>").val(datax.id).html(datax.name));
              });

            }

          }
        });

      }

    });

    $('.js-example-basic-multiple').select2();

    $('#country').change(function() {
      if($(this).val())
      {
        $.ajax({
          type:"GET",
          url:'{{route('admin.trip.get-cities')}}',
          data:{id:$(this).val()},//only input
          success: function(response,status){
            debugger

            var json_response = JSON.parse(response);

            if (json_response.data=='false'){
              $('.places').empty();

              var cities =[];
              cities = json_response.data;
              $('.places').append($("<option></option>").val(0).html('Select'));
            }
            else {
              $('.places').empty();

              var cities =[];
              cities = json_response.data;
              $('.places').append($("<option></option>").val(0).html('Select place'));

              $.each(cities , function (key,datax){
                $('.places').append($("<option></option>").val(datax.id).html(datax.name));
              });

            }

          }
        });

      }
      else{
        $('.places').empty();
      }

    });

    $('body').on('change','.places',function() {

      var thiss = $(this);
      if($(this).val())
      {
        $.ajax({
          type:"GET",
          url:'{{route('admin.trip.getExperiencesProperties')}}',
          data:{id:$(this).val()},//only input
          success: function(response,status){
            debugger
            $('.js-example-basic-multiple').select2();

            var json_response = JSON.parse(response);

            if (json_response.data=='false'){
              // thiss.parents('place_div').find('.experiences')
              thiss.parents('.place_div').find('.experiences').empty();
              thiss.parents('.place_div').find('.properties').empty();

              var cities =[];

              thiss.parents('.place_div').find('.experiences').append($("<option></option>").val(0).html('Select'));
              thiss.parents('.place_div').find('.properties').append($("<option></option>").val(0).html('Select'));
            }
            else {
              // $('.experiences').empty();
              thiss.parents('.place_div').find('.experiences').empty();
              thiss.parents('.place_div').find('.properties').empty();

              var experiences =[];
              var properties =[];

              experiences = json_response.data_experiences;
              properties = json_response.data_properties;
              // $('.experiences').append($("<option></option>").val(0).html('Select'));
              thiss.parents('.place_div').find('.experiences').append($("<option></option>").val(0).attr('disabled','disabled').html('Select experience'));

              $.each(experiences , function (key,datax){
                // $('.experiences').append($("<option></option>").val(datax.id).html(datax.title));
                thiss.parents('.place_div').find('.experiences').append($("<option></option>").val(datax.id).html(datax.title));
              });


              thiss.parents('.place_div').find('.properties').append($("<option></option>").val(0).attr('disabled','disabled').html('Select property'));

              $.each(properties , function (key,datax){
                thiss.parents('.place_div').find('.properties').append($("<option></option>").val(datax.id).html(datax.title));
              });

            }

          }
        });

      }
      else{
        thiss.parents('.place_div').find('.experiences').empty();
        thiss.parents('.place_div').find('.properties').empty();
      }

    });
  });
</script>
@endpush
