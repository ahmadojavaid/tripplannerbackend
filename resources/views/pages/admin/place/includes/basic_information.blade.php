<div class="basic-information-container">
  @if(isset($place))
  {!! Form::model($place, ['route' => ['admin.country.place.update', $place->id]]) !!}
  {{ method_field('PATCH') }}

  @else
  {!! Form::open(['url' => route('admin.country.place.store')]) !!}

  @endif
  <div class="row">
    <div class="col-12">
      {{Form::fieldText('name')}}
    </div>
    <div class="col-12">
      {{Form::fieldSelect2('country',$countryArr,null,'Select Country')}}
    </div>
    <div class="col-6">
      {{Form::fieldText('short_code')}}
    </div>
    <div class="col-6">
      {{Form::fieldText('instagram_tag')}}
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
    <div class="col-6">

      {{Form::fieldSelect('type',$typeArr)}}
    </div>
    <div class="w-100"></div>
    <div class="col-12">
      {{Form::fieldTextarea('short_description')}}
    </div>
  </div>
  <div class="form-group">
    <button class="btn btn-outline-primary handle-basic-information">Store</button>
  </div>

  {!! Form::close() !!}
</div>
