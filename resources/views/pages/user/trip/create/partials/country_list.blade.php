{{-- <ul class="nav nav-tabs tabbable" role="tablist"> --}}
@foreach ($data as $key=>$name)
@php
$active = $key == $data->keys()->first()?'active' :"";
@endphp
<li class="nav-item">
  <a class="nav-link {{$active}}" data-id="{{$key}}" data-toggle="tab" role="tab" aria-controls="place-{{$key}}"
    aria-selected="true">
    {{$name}}
  </a>
</li>

@endforeach
{{-- </ul> --}}
