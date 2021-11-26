<div class="row">
  <div class="col-12">
    {{Form::fieldText('name')}}
  </div>
  <div class="col-6">
    {{Form::fieldSelect('status',$statusArr)}}
  </div>
  <div class="col-6">
    {{Form::fieldSelect('priority',$priorityArr)}}
  </div>
</div>
