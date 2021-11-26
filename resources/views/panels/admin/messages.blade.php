@if ($message = Session::get('success'))
<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <p class="mb-0">
    {{$message}}
  </p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@elseif($message = Session::get('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <p class="mb-0">
    {{$message}}
  </p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
@endif
