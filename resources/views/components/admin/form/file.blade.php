<div class="form-group">
  {{ Form::label($label ? $label:$name, null) }}

  <div class="custom-file">

    {{
    Form::file($name,
      // ['class'=> 'custom-file-input' , "id"=> "$name" ]
      array_merge(['class'=> 'custom-file-input' , "id"=> "$name"], $attributes))
    }}
    {{ Form::label($value,null, [
      'class' => ($errors->has($name)) ? 'custom-file-label form-control  is-invalid' : 'custom-file-label form-control' ,
      "id"=> "$name", 'for'=> "$name" ] ) }}
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
</div>
