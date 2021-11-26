<div class="form-body">
  <div class="row">
    <div class="col-12">
      {{Form::fieldText('name')}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect('status' ,  $statusArr)}}
    </div>

  </div>
</div>
