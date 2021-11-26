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

{{-- {{dd($errors)}} --}}
<div class="row h-100">
  <div class="col-12">
    <div class="card">
      {{-- <div class="card-header">
        <h4 class="card-title">How it Works</h4>
      </div> --}}
      <div class="card-content">
        <div class="card-body">
          <form method="POST" action="{{ route('admin.setting.store.how-it-work-video') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-lg-6 col-md-12">
              <fieldset class="form-group">
                <label for="basicInputFile">Upload Video</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="video" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">Choose Video</label>
                </div>
              </fieldset>
              <button class="btn btn-outline-primary">Upload</button>
            </div>
          </form>
          <div class="p-2">

            <div class="video-player" id="plyr-video-player">
              <div class="video-grid embed-responsive embed-responsive-16by9">
                <video class="embed-responsive-item" src="{{asset('/user/images/'.$setting->value)}}"></video>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/media/plyr.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/media/plyr.polyfilled.js')) }}"></script>

@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/extensions/media-plyr.js')) }}"></script>
@endsection
