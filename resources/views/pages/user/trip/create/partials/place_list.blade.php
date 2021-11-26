<div class="row">
  @forelse ($data as $index=>$place)
  <div class="col-lg-4 col-md-4">
    <div class="single-trip-card">
      <div id="place-carsoursel-{{$index+1}}" class="carousel slide single-img carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
          <button type="button" class="btn btn-primary py-0 carousel-edit-btn font-weight-light add-place"
            data-id="{{$place->id}}">
            Add +
          </button>
          @foreach ($place->placeFiles as $key =>$item)
          @php
          $active = $key == collect($place->placeFiles)->keys()->first()?'active' :"";
          @endphp
          <div class="carousel-item {{$active}} ">
            <img src="{{$item->getFile($item->id)}}" alt="..." class="rounded">
          </div>
            <div class="carousel-caption">
              <h5>{{$place->name}}</h5>
            </div>
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#place-carsoursel-{{$index+1}}" role="button" data-slide="prev">
          <span class="fa fa-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#place-carsoursel-{{$index+1}}" role="button" data-slide="next">
          <span class="fa fa-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
  @empty
  <p class="col">No Place Found</p>
  @endforelse

</div>
