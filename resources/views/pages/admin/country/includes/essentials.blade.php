<div class="essential-container">
  {!! Form::model($country, ['route' => ['admin.country.essentials', $country->id]]) !!}
  <div class="row">
    <div class="col-12">
      {{Form::fieldTextarea('when_to_go')}}
    </div>
    <div class="col-12">
      {{Form::fieldTextarea('weather')}}
    </div>
    <div class="col-12">
      {{Form::fieldTextarea('getting_there')}}
    </div>
    <div class="col-12">

      {{Form::fieldTextarea('travel_expenses')}}
    </div>
    <div class="col-12">

      {{Form::fieldTextarea('culture')}}
    </div>

  </div>
  <div class="form-group">
    <button class="btn btn-outline-primary handle-essential">Store</button>
  </div>
  {!! Form::close() !!}
</div>
