<div class="country-visitor pt-lg-3 pt-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item">
        <a
          href="{{route('user.country.detail' , $property->propertyPlace->placeCountry->slug)}}">{{ $property->propertyPlace->placeCountry->name}}</a>
      </li>
      <li class="breadcrumb-item">
        <a href="{{route('user.place.detail' , $property->propertyPlace->slug)}}">{{$property->propertyPlace->name}}</a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">
        {{$property->title}}
      </li>
    </ol>
  </nav>
</div>
