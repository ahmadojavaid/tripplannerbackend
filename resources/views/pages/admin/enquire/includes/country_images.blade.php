@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/ui/prism.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/file-uploaders/dropzone.min.css')) }}">
@endpush
@push('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/plugins/file-uploaders/dropzone.css')) }}">
@endpush

<div class="row">
  <div class="col-12">
    <div class="body-nest" id="DropZone">
      <div id="myDropZone" class="dropzone">
      </div>
    </div>
  </div>
</div>
@push('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/extensions/dropzone.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>
@endpush
@push('page-script')
@include('pages.admin.trip.partials.croppie')

<script>
  //for custom handling
  const csrfToken = $('meta[name="csrf-token"]').attr('content');
  let storeUrl = "{{route('admin.country.file.store', 'NaN')}}";
  let updateUrl = "{{route('admin.country.file.upload','NaN')}}";
  let destroyUrl = "{{route('admin.country.file.destroy','NaN')}}";
  storeUrl = storeUrl.replace('NaN' , "{{$country->id}}");
  // console.log('storeUrl' , storeUrl);
  updateUrl = updateUrl.replace('NaN' , "{{$country->id}}")
  destroyUrl = destroyUrl.replace('NaN' , "{{$country->id}}")

  Dropzone.autoDiscover = false;
  var myDropzone = new Dropzone("div#myDropZone", {
    url: storeUrl,
    // autoProcessQueue: false,
    autoProcessQueue: false,
    headers: {
      'X-CSRF-TOKEN': csrfToken
    },
    addRemoveLinks : true,
    maxFiles: 25,
    // maxFilesize: 5,

    init: function() {

      myDropzone  = this;

      $.ajax({
        headers:{
        'X-CSRF-TOKEN': csrfToken
        },
        url: updateUrl,
        type: 'post',
        dataType: 'json',
        success: function(response){
          $.each(response, function(key,value) {
            var mockFile = { name: value.name, size: value.size };
            myDropzone.emit("addedfile", mockFile);
            myDropzone.emit("thumbnail", mockFile, value.path);
            myDropzone.emit("complete", mockFile);
          });
          //maintain count of maxFiles
          myDropzone.options.maxFiles = myDropzone.options.maxFiles - response.length;
        }
      });
    }
  });


  const image_crop = $('#image_demo').croppie({
      viewport: {
          width: 300,
          height: 200,
          // type:'circle' //circle
      },
      boundary:{
          width:"100%",
          height:500
      },
      enableExif: true
  });
  let rawImg ='';


    $('#profile-image-modal').on('shown.bs.modal', function(e){
      image_crop.croppie('bind', {
        url: rawImg
      }).then(function(){
            console.log('jQuery bind complete');
        });
    });


  myDropzone.on("success", function(file, response) {

    if (file.cropped) {
        return;
    }
    file.serverData = response.name;
  });


  myDropzone.on("complete", function(file,response) {
    //handling serverData for file uploaded from server
    if(!file.serverData)
    file.serverData = file.name;
  });

  myDropzone.on('thumbnail',function(file){

    if(file instanceof File){
      const reader = new FileReader();

      reader.onload = function (e) {
        $('#profile-image-modal').modal('show');
        rawImg = e.target.result;
      }

      // cache filename to re-assign it to cropped file
      reader.readAsDataURL(file);
      var cachedFilename = file.name;
      myDropzone.removeFile(file);



      $('#uploader').on('change',function() {
        profileImage(this);
      });


      $(document).on('click' ,'.crop_image', function(event){
        event.stopImmediatePropagation();

        image_crop.croppie('result', {
            type: 'blob',
            size:{height:1200 , width:1600}
        }).then(function(response){
          $('#profile-image-modal').modal('hide');
          response.name = cachedFilename;

          // add cropped file to dropzone
          myDropzone.addFile(response);
          // upload cropped file with dropzone
          myDropzone.processQueue();
        });
        return;
      });
    }
  });


  myDropzone.on("error", function(file, response ,data) {

    if(data)
      toastr.error( 'Only Images Allowed','Invalid File Format', { "closeButton": true });
    else
    toastr.warning( response,'Exceed', { "closeButton": true });
    this.removeFile(file);
  });

  myDropzone.on("removedfile", function(file) {
    if (!file.serverData) { return; }
    $.ajax({
      headers:{
        'X-CSRF-TOKEN': csrfToken
      },
      type:'POST',
      url:destroyUrl,
      data:{
        name: file.serverData
      }
    });
  });
</script>
@endpush
