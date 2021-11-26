<div class="page-section">
  <div class="section-head">
    <h2 class="section-title mb-4">Where to go</h2>
    <div class="section-content">
      <div class="padding-spacing with-three owl-carousel">
        @forelse ($country->countryCities as $collection)

        <div>
          <div id="place-{{$collection->id}}" class="carousel slide single-img carousel-fade" data-ride="carousel">
            <div class="carousel-inner">

              <a href="{{route('user.place.detail',$collection->slug)}}">
                @foreach ($collection->placeFiles as $key =>$item)
                @php
                $active = $key == collect($collection->placeFiles)->keys()->first()?'active' :"";
                @endphp
                <div class="carousel-item {{$active}} ">
                  <img src="{{$item->getFile()}}" class="box-size-img rounded" alt="...">
                  <div class="carousel-caption  ">
                    <h5>{{$collection->name}}</h5>
                  </div>
                </div>
                @endforeach
              </a>

            </div>
            <a class="carousel-control-prev" href="#place-{{$collection->id}}" role="button" data-slide="prev">
              <span class="fa fa-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#place-{{$collection->id}}" role="button" data-slide="next">
              <span class="fa fa-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        @empty
        <p>No Place found</p>
        @endforelse
      </div>

    </div>
    <div class="section-footer border-b">
      <button class="btn-primary btn" href="#">View more</button>
    </div>
  </div>
</div>
