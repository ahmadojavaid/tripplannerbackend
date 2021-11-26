<div class="form-label-group">
  {{ Form::password($name, array_merge(['class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control' , 'placeholder'=> $placeholder ? $placeholder: ucwords(str_replace('_', ' ', $name)) ], $attributes)) }}
  {{ Form::label($name, null) }}
  @error($name)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
