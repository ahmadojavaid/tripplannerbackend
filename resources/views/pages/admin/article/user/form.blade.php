@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endpush
<div class="form-body">
  <div class="row">
    <div class="col-12">
      {{Form::fieldText('title')}}
    </div>
    <div class="col-12">
      {{Form::fieldText('sub_title')}}
    </div>
    <div class="col-12">
      {{Form::fieldTextEditor('description')}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('country' ,  $countryArr)}}
    </div>
    @if (Auth::user()->isAdmin())
    <div class="col-12">
      {{Form::fieldSelect('status' ,  $statusArr)}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('priority_status' ,  $priorityStatusArr)}}
    </div>
    @endif
    <div class="col-12">
      {{Form::customSelect('associatedCountries[]' ,[
        'data' => $associatedCountries,
        "multiple" =>  true ,
        'label' => "Associated Countries",
        'class' => 'select2 form-control',
        'placeholder'=>false,
        'select2' =>[
          'data-placeholder' => "Select Country",
          'data-width' => "100%"
        ]
      ])}}
    </div>

    <div class="col-12">
      {{Form::customSelect('associatedPlaces[]' ,
      [
        'data' => $associatedPlaces,
        'placeholder' => false,
        "multiple" =>  true,
        'label' => "Associated Places",
        'class' => 'select2 form-control',
        'select2' =>[
          'data-placeholder' => "Select Place",
          'data-width' => "100%"
        ]
      ]
      )}}
    </div>
    <div class="col-12">
      {{Form::fieldFile('photo', null, 'Featured Image')}}
    </div>
    <div class="col-12">
      {{Form::fieldText('reading_time')}}
    </div>
  </div>

  {!! Form::file('quillUpload', ['id'=>'quill-uploader' , 'class' => 'd-none']) !!}

  @push('vendor-script')
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  @endpush
  @push('page-script')
  <script>
    $('document').ready(function(){
    $('.select2').select2();
    const modules = {
      formula: true,
      syntax: true,
      toolbar: [
        [
          {
            font: []
          },
          {
            size: []
          }
        ],
        ["bold", "italic", "underline", "strike"],
        [
          {
            color: []
          },
          {
            background: []
          }
        ],
        [
          {
            script: "super"
          },
          {
            script: "sub"
          }
        ],
        [
          {
            header: "1"
          },
          {
            header: "2"
          },
          // "blockquote",
          // "code-block"
        ],
        [
          {
            list: "ordered"
          },
          {
            list: "bullet"
          },
          {
            indent: "-1"
          },
          {
            indent: "+1"
          }
        ],
        // [
        //   "direction",
        //   {
        //     align: []
        //   }
        // ],
        ["link", "image"],
        ["new-hotel" ]
        // ["new-hotel" , "hotel-list"]
      ]
    };
    var quillEditor = new Quill("#editor-description.quill-editor", {
      bounds: ".quill-editor",
      modules: {...modules},
      theme: "snow"
    });



    //need to validate the working of innerHtml
    //Not able to test it completly
    var description = document.querySelector('input[name=description]'); // set name input var
    quillEditor.on('text-change', function(delta, oldDelta, source) {
      description.value = quillEditor.root.innerHTML;
    });
    quillEditor.root.innerHTML = description.value;


    function imageFinder() {
      var imgs = $('.quill-editor.ql-container img');
      var imgSrcs = [];

      for (var i = 0; i < imgs.length; i++) {
        if(imgs[i].src.includes(';base64'))
        imgSrcs.push(imgs[i].src);
      }
      return JSON.stringify(imgSrcs);
    }


    $(document).on('submit' ,  'form' , function(){
      $('#description_images_container').val(imageFinder());
    });


    // extending file upload working
    let selection = null;


    quillEditor.getModule('toolbar').addHandler('image', () => {
      selection=quillEditor.getSelection();

      handleFile();
    });


    function handleFile() {
      const input = document.createElement('input');
      // input.setAttribute('type', 'file');
      // input.setAttribute('id' , 'quill-uploader');
      // console.log('input',input);

      // input.click();
      $('input#quill-uploader').click();
      handleCropFile();
    }


    //croppie
    function handleCropFile(){
        // let quillRawImg ='';
        $('#image_demo').croppie('destroy');
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


      $(document).on('change','#quill-uploader',function() {

        profileImage(this);
      });

      $('.crop_image').click(function(event){
        event.stopImmediatePropagation();
        image_crop.croppie('result', {
          type: 'canvas',
          size: {
            height:1200,
            width:1600
          },
        }).then(function(response){

            quillEditor.insertEmbed(selection.index, 'image', response);
            $('#profile-image-modal').modal('hide');
        });
      });
    }






    //custom option working

    const newHotel = $('.ql-new-hotel');
    newHotel.html('New Hotel').css("width","75px");

    const hotelList = $('.ql-hotel-list');
    hotelList.html('Hotel List').css("width","75px");



    newHotel.click(function(){
      selection=quillEditor.getSelection();
      $('#add-external-hotel').modal('show');
    });

    $('#add-external-hotel').on('hidden.bs.modal' , function(){
        if(!selection){
          var delta = {
            ops: [
              {insert: window.newHotel.slug, attributes: {link: "change-it"}}
            ]
          };
        }else{
          var delta = {
            ops: [
              {retain: selection.index},
              {insert: window.newHotel.slug, attributes: {link: "change-it"}}
            ]
          };
        }
        quillEditor.updateContents(delta);

        const link = $('a[href="change-it"]');
        link.attr('data-slug', window.newHotel.slug);
        link.attr('class', "external-hotel");
        link.attr('href',window.newHotel.link);
    });

  });

  </script>
  @endpush
