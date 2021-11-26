{!! Form::model($country->countryVideo, ['route' => ['admin.country.videos', $country->id]]) !!}
<div class="row">
  <div class="col-12">
    {{Form::fieldText('title')}}
  </div>
  <div class="col-12">
    {{Form::fieldTextarea('description')}}
  </div>
  <div class="col-12">
    {{Form::fieldText('link_1')}}
  </div>
  <div class="col-12">
    {{Form::fieldText('link_2')}}
  </div>
  <div class="col-12">
    {{Form::fieldText('link_3')}}
  </div>
</div>
<div class="form-group">
  <button class="btn btn-outline-primary">Store</button>
</div>
{!! Form::close() !!}
