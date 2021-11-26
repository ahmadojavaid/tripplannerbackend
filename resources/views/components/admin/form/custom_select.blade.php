<div class="form-group">
  @php

  $value = isset($options['value']) ? $options['value']:null;
  //need to check the wokring on every select []

  $customName = $name;
  if(Str::contains($name, '['))
  $customName = preg_replace("/[^a-zA-Z-]+/", "", $name);
  // $customName = preg_replace("/[^a-zA-Z-]-+/", "", $customName);



  $placeholder = isset($options['placeholder']) ? $options['placeholder']:ucwords($customName);

  $class = isset($options['class']) ? $options['class'] : 'form-control';
  $classNames = ($errors->has($customName)) ? $class.' is-invalid' : $class;

  $label = isset($options['label']) ? $options['label'] :ucwords(str_replace('_', ' ', $customName));
  $multiple = isset($options['multiple']) ? $options['multiple']:false;

  $id = isset($options['id']) ? $options['id']: $name;


  $data = isset($options['data']) ? $options['data']:[];

  //field options
  $fieldOptions =
  [
  'class' => $classNames,
  'multiple' => $multiple,
  'placeholder' => $placeholder,
  'id' => $id,
  ];

  //select2 options
  if(isset($options['select2']))
  $fieldOptions = array_merge($fieldOptions , $options['select2']);

  //data attr options
  if(isset($options['data-attr']))
  $fieldOptions = array_merge($fieldOptions , $options['data-attr']);

  if(isset($options['disabled']))
  $fieldOptions['disabled'] = $options['disabled'];


  if(isset($options['placeholder']) && $options['placeholder'] == false){
  unset($fieldOptions['placeholder']);
  }
  if(isset($options['id']) && $options['id'] == false){
  unset($fieldOptions['id']);
  }
  @endphp



  {{ Form::label($label) }}
  {{Form::select($name,$data,$value , $fieldOptions) }}

  @error($customName)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
