@push('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.bubble.css')) }}">
<style>
  .ql-editor {
    min-height: 200px;
  }
</style>
@endpush

<div class="form-group">
  {{ Form::label($name) }}
  {{ Form::hidden($name, $value,
    array_merge(['class' => ($errors->has($name)) ? 'form-control is-invalid' : 'form-control' ,
    'placeholder'=> $placeholder ? $placeholder: ucwords(str_replace('_', ' ', $name)) ], $attributes))
  }}
  {{Form::file($name.'_images', $attributes = ['class' => 'd-none' ,'id' => $name.'_images'])}}
  {{Form::text($name.'_images_container',null,  $attributes = ['class' => 'd-none' ,'id' => $name.'_images_container'])}}
  {{Form::text($name.'_images_delete',null,  $attributes = ['class' => 'd-none' ,'id' => $name.'_images_delete'])}}

  <div class="quill-editor" id="editor-{{$name}}">
  </div>
  @error($name)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
@push('vendor-script')
<script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
@endpush
