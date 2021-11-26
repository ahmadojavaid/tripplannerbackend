<div class="container">
  <div class="row ">
    @foreach ($countries->chunk(4) as $collection)
    <div class="text-left col-sm-4">
      @foreach ($collection as $item)
      <a href="{{route('user.country.detail',$item->slug)}}" class="dropdown-item">{{$item->name}}</a>
      @endforeach
    </div>
    @endforeach

  </div>
</div>
