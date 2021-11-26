@php
$icon = "fa fa-heart-o";
$class ="display-login";

if(!Auth::guest())
{
if($trip->favourite)
$icon = "fa fa-heart";
$class = "handle-favourite";
}
@endphp
<a href="javascipt:void(0)" data-id="{{$trip->id}}" class="{{$class}}">
  <i class="{{$icon}} text-danger"></i>
</a>
