<div class="basic-information-container">
  @if(isset($country))
  {!! Form::model($country, ['route' => ['admin.country.update', $country->id]]) !!}
  {{ method_field('PATCH') }}

  @else
  {!! Form::open(['url' => route('admin.country.store'),'files' => true]) !!}

  @endif
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
    <div class="col-6">
      {{Form::fieldText('latitude')}}
    </div>
    <div class="col-6">
      {{Form::fieldText('longitude')}}
    </div>
    <div class="col-12">
      {{Form::fieldTextarea('short_description')}}
    </div>
  </div>
  <div class="form-group">
    <button class="btn btn-outline-primary handle-basic-information">Store</button>
  </div>

  {!! Form::close() !!}
</div>
