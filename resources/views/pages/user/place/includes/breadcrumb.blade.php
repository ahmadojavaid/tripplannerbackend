<div class="country-visitor pt-lg-3 pt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a
          href="{{route('user.country.detail' , $place->placeCountry->slug)}}">{{$place->placeCountry->name}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">
        {{$place->name}}
      </li>
    </ol>
  </nav>
</div>
