<div class="row">
  <div class="col-12">
    {{Form::fieldText('title')}}
  </div>
  <div class="col-12">
    {{Form::fieldSelect2('country',$countryArr,null,'Select Country')}}
  </div>
  <div class="col-12">
    {{Form::fieldText('price')}}
  </div>

  <div class="col-12">
    {{Form::fieldSelect('status',$statusArr)}}
  </div>

  <div class="col-12">
    {{Form::fieldFile('photo')}}
  </div>
</div>
