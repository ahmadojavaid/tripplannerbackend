<div class="form-label-group">
  @php
  $label = ucwords(str_replace(['-','_'], ' ', $name));
  @endphp

  {{ Form::textarea($name, $value, array_merge(['class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control' , 'placeholder'=> $placeholder ? $placeholder: $label ], $attributes)) }}

  @error($name)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
