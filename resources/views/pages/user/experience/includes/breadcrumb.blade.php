<div class="country-visitor pt-lg-3 pt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item">
        <a
          href="{{route('user.country.detail' , $experience->experiencePlace->placeCountry->slug)}}">{{ $experience->experiencePlace->placeCountry->name}}</a>
      </li>
      <li class="breadcrumb-item">
        <a
          href="{{route('user.place.detail' , $experience->experiencePlace->slug)}}">{{$experience->experiencePlace->name}}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{$experience->title}}
      </li>
    </ol>
  </nav>
</div>
