<div class="form-group">

  {{ Form::label($name, null) }}
  {{Form::select($name,$data, $value,
    array_merge([
      'class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control' ,
      'placeholder'=> $placeholder ? $placeholder: ucwords(str_replace('_', ' ', $name)) ],
      $attributes
    )
  ) }}
  @error($name)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
