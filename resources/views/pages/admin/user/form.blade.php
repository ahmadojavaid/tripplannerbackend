<div class="form-body">
  <div class="row">
    <div class="col-12">
      {{Form::fieldText('first_name')}}
    </div>
    <div class="col-12">
      {{Form::fieldText('last_name')}}
    </div>
    <div class="col-12">
      {{Form::fieldText('phone_no')}}
    </div>
    <div class="col-12">
      {{Form::fieldEmail('email')}}
    </div>
    <div class="col-12">
      {{Form::fieldPassword('password')}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('role', $roleArr, null, 'Select Role',[
        'class'=>($errors->has('role')) ? 'form-control text-capitalize user-role is-invalid' : 'form-control text-capitalize user-role'
        ])}}
    </div>
    <div class="col-12 my-2">
      @include('pages.admin.user.includes.checkbox')
    </div>
  </div>
</div>
