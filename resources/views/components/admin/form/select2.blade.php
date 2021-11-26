@push('vendor-style')
<!-- vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
@endpush
<div class="form-group">
  @php
  $placeholder =$placeholder ? $placeholder: ucwords(str_replace('_', ' ', $name));
  if(!isset($attributes['multiple']))
  $attributes['placeholder'] =$placeholder;

  $customName = preg_replace("/[^a-zA-Z]+/", "", $name);
  @endphp
  {{ Form::label($label ? $label:$customName, null) }}
  {{Form::select($name,$data, $value,
    array_merge([
      'class' => ($errors->has($customName)) ? 'form-control select2 is-invalid' : 'form-control select2' ,
      // "multiple"=>"multiple"
      // 'placeholder'=> $placeholder
     ],
      $attributes
    )
  ) }}
  @error($customName)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
@push('vendor-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
@endpush
@push('page-script')
{{-- <script src="{{ asset(mix('js/scripts/forms/select/form-select2.js')) }}"></script> --}}
<script>
  const select2 =  $('.select2');
  if(select2.length !==0)
  $(".select2").select2({
    dropdownAutoWidth: true,
    width: '100%',
    placeholder: "{{$placeholder}}",
    tags: "{{$tag}}"
  });
</script>
@endpush
