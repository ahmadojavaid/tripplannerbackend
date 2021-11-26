<div class="row">
  <div class="col-12">
    {{Form::fieldText('title')}}
  </div>
  <div class="col-12">
    {{Form::fieldSelect2('country',$countryArr,null,'Select Country')}}
  </div>
  <div class="col-12">
    {{Form::fieldTextarea('description')}}
  </div>
  <div class="col-12">
    {{Form::fieldSelect('status',$statusArr)}}
  </div>
  <div class="col-12">
    {{Form::fieldSelect('priority_status',$priorityStatusArr)}}
  </div>
  <div class="col-12">
    <div class="row">
      <div class="col-md-6">
        {{Form::fieldText('latitude')}}
      </div>
      <div class="col-md-6">
        {{Form::fieldText('longitude')}}
      </div>
    </div>
  </div>
  <div class="col-12">
    {{Form::fieldFile('photo')}}
  </div>
</div>
