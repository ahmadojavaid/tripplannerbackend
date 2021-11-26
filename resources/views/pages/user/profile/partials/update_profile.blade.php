{!! Form::model(auth()->guard('web')->user(), ['route' => ['user.profile.update', auth()->guard('web')->user()->id ,
],'files' => true])
!!}
{{ method_field('PATCH') }}
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="avatar-wrapper">
        <img class="profile-pic" src="{{auth()->guard('web')->user()->getAvatar()}}" />
        <div class="upload-button">
          <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
        </div>
        <input class="file-upload" name="avatar" type="file" accept="image/*" />
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="firstName">First Name</label>
        {{ Form::text('first_name' ,null, ['class' => ($errors->has('first_name')) ? 'form-control is-invalid' : 'form-control' , 'placeholder'=> 'First Name'])}}
        @error('first_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="secondName">Last Name</label>
        {{ Form::text('last_name' ,null, ['class' => ($errors->has('last_name')) ? 'form-control is-invalid' : 'form-control' , 'placeholder'=> 'Last Name'])}}
        @error('last_name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label for="exampleInputEmail1">Email </label>
        {{ Form::email('email' ,null, ['class' => ($errors->has('email')) ? 'form-control is-invalid' : 'form-control' , 'placeholder'=> 'Email'])}}
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    <div class="col-lg-6">
      <div class="form-group">
        <label for="Phone">Phone Number</label>
        {{ Form::text('phone_no' ,null, ['class' => ($errors->has('phone_no')) ? 'form-control is-invalid' : 'form-control' , 'placeholder'=> 'Phone Number'])}}
        @error('phone_no')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="form-group">
        <a href="*Change Password"></a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <button class="btn-primary btn mr-2" href="#">
        Save Changes
      </button>
      <a class="btn-secondary btn" href="{{route('user.auth.logout')}}">
        Log Out
      </a>
    </div>
  </div>
</div>
{!! Form::close() !!}
