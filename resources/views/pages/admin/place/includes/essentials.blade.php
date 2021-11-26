<div class="essential-container">
  {!! Form::model($place, ['route' => ['admin.country.place.essentials', $place->id]]) !!}
  <div class="row">
    @foreach ($essentailFields as $field)
    <div class="col-12">
      {{Form::fieldTextarea($field, isset($essentailFieldData[$field])?$essentailFieldData[$field]: null )}}
    </div>
    @endforeach

  </div>
  <div class="form-group">
    <button class="btn btn-outline-primary handle-essential">Store</button>
  </div>
  {!! Form::close() !!}
</div>
