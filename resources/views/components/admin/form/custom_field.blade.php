<div class="form-label-group">
  @php
  $label = ucwords(str_replace(['-','_'], ' ', $name));


  $customName = $label;
  $class = isset($options['class']) ? $options['class'] : 'form-control';
  $classNames = ($errors->has($customName)) ? $class.' is-invalid' : $class;
  $id = isset($options['id']) ? $options['id']: $name;

  $value = null;
  if(isset($options['value']))
  $value = $options['value'];

  $placeholder = $label;
  if(isset($options['placeholder']))
  $placeholder = $options['placeholder'];



  //field options
  $fieldOptions =
  [
  'class' => $classNames,
  'placeholder' => $placeholder,
  'id' => $id,
  ];
  if(isset($options['disabled'])){
  $fieldOptions['disabled'] = $options['disabled'];
  }

  @endphp
  {{ Form::text($name, $value, $fieldOptions) }}
  {{ Form::label($label, null) }}
  @error($name)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
