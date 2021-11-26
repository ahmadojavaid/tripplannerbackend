<div class="checkbox my-2">
  <div class="vs-checkbox-con vs-checkbox-primary">
    {{Form::checkbox($name, $value, $checked) }}
    <span class="vs-checkbox">
      <span class="vs-checkbox--check">
        <i class="vs-icon feather icon-check"></i>
      </span>
    </span>
    <span class="">{{$label}}</span>
  </div>
</div>
