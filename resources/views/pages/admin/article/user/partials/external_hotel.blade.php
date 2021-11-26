{{-- Modal --}}
<div class="modal fade text-left" id="add-external-hotel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Update Profile Image</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="hotel" action="{{route('admin.country.external.hotel.store')}}" method="POST"
          enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="form-label-group">
                <input class="form-control" placeholder="Title" name="title" type="text">
                <label for="title">Title</label>
              </div>
            </div>
            <div class="col-12">
              <div class="form-label-group">
                <input class="form-control" placeholder="Short Description" name="description" type="text">
                <label for="title">Short Description</label>
              </div>
            </div>
            <div class="col-6">
              <div class="form-label-group">
                <input class="form-control" placeholder="Link" name="link" type="text">
                <label for="title">Link</label>
              </div>
            </div>
            <div class="col-6">
              <div class="custom-file">
                <input class="custom-file-input" id="hotelUploader" name="hotelUploader" type="file">
                <input id="hotelPicture" name="picture" type="hidden">
                <label for="" class="custom-file-label form-control" id="picture"></label>
              </div>
            </div>
          </div>

          <div class="form-group">
            <button class="btn btn-outline-primary store-hotel" type="button">Store</button>
          </div>
        </form>
      </div>
      <div class="modal-footer justify-content-center py-2">
        {{-- <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success crop_image">Crop</button> --}}

      </div>
    </div>
  </div>
</div>

















@include('pages.admin.trip.partials.croppie')

{{-- forgot-password-modal --}}
@push('page-script')
<script>
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click' ,'.store-hotel' , function(e){
      e.preventDefault();
      const form = $('form#hotel');
      window.newHotel = null;
      $.ajax({
        type: "post",
        url:form.attr('action'),
        data:form.serialize(),
        success:function(data){
          window.newHotel = data;
          $('#add-external-hotel').modal('hide');
        },
        error:function({status, responseJSON}){
          form.find('span.error').remove();

          if(status===422)
          {
            $.each(responseJSON, function (i, error) {
              var el = form.find('[name="'+i+'"]');
              el.after($('<span class="error text-danger">'+error[0]+'</span>'));
            });
          }
        }
      });
    });

    initCroppieJs();
    //croppie
    function initCroppieJs(){
        window.rawImg ='';
        const image_crop = $('#image_demo').croppie({
            viewport: {
                width: 200,
                height: 200,
                // type:'circle' //circle
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


      $('#hotelUploader').on('change',function() {
        profileImage(this);
      });

      $('.crop_image').click(function(event){
        image_crop.croppie('result', {
          type: 'canvas',
          size: {
            height:422,
            width:380
          },
        }).then(function(response){
            $('#display-image').attr('src', response);
            $('input#hotelPicture:hidden').val(response);
            $('#profile-image-modal').modal('hide');
        });
      });
    }
  });
</script>
@endpush
