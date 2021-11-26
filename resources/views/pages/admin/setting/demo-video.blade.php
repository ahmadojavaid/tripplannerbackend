@extends('layouts.admin.contentLayoutMaster')

@section('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/plyr.css')) }}">
@endsection
@section('page-style')
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/plugins/extensions/media-plyr.css')) }}">
@endsection
@section('title', 'How It Works')

@section('content')

<div class="row h-100">
  <div class="col-12">
    <div class="card">
      <div class="card-content">
        <div class="card-body">
          <form method="POST" id="how-it-work-video-form" action="{{ route('admin.setting.store.how-it-work-video') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-lg-6 col-md-12">
              <fieldset class="form-group">
                <label for="basicInputFile">Upload Video</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="video" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose Video</label>
                </div>
                <span class="invalid-feedback d-block" role="alert">
                  <strong class="video-error"></strong>
                </span>
              </fieldset>
              <div class="progress progress-bar-primary progress-lg">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                  style="width:0%">0%</div>
              </div>
              <button class="btn btn-outline-primary">Upload</button>
            </div>
          </form>
          <div class="p-2">
            <div class="video-player" id="plyr-video-player">
              <div class="video-grid embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item" src="{{$setting->getHowItWorkVideo()}}"></video>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/media/plyr.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/media/plyr.polyfilled.js')) }}"></script>

@endpush
@push('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/extensions/media-plyr.js')) }}"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script>
  $(document).ready(function() {

    const progressBar = $('.progress-bar');
    const errorMessage = $('.video-error');
    console.log();
    $('#how-it-work-video-form').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            progressBar.html(percentVal);
            progressBar.css({ width:percentVal  });
            errorMessage.empty();
        },
        uploadProgress: function(event, position, total, percentComplete) {
          progressBar.attr('aria-valuenow' , progressBar.attr('aria-valuenow' ,percentComplete ));
          var percentVal = percentComplete + '%';
          progressBar.html(percentVal);
          progressBar.css({ width:percentVal  });
        },
        error:function({responseJSON}){
          var percentVal = '0%';
          progressBar.html(percentVal);
          progressBar.css({ width:percentVal  });
          errorMessage.html(responseJSON.video[0]);
        },
        success:function(xhr){
          $('.embed-responsive-item').attr('src' , xhr);
        }
    });



  });
</script>
@endpush
