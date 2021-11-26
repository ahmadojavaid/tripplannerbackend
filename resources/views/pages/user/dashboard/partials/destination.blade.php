<div class="page-section">
  <div class="destination-section">
    <div class="container">
      <div class="section-content">
        <div class="row justify-content-between">

          @forelse ($countries->chunk(4) as $collection)
          <div class="text-left col-sm-4 col-6">
            @foreach ($collection as $item)
            <a href="{{route('user.country.detail',$item->slug)}}" class="dropdown-item">{{$item->name}}</a>
            @endforeach
          </div>
          @empty
          <p>No Destination</p>
          @endforelse
        </div>
      </div>
{{--      <div class="section-footer border-b">--}}
{{--        <button class="btn-primary btn" href="#">View all</button>--}}
{{--      </div>--}}
    </div>
  </div>
</div>
