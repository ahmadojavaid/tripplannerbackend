<div class="section-content">
  <div class="icon-heading tinny-view">
    <h3>
      <img src="{{asset('user/images/property.png')}}" alt="" />
      <span>Properties in </span> {{$data->name}}
    </h3>
  </div>
  <div class="padding-spacing with-three owl-carousel owl-loaded owl-drag">
    <div class="owl-stage-outer">
      <div class="owl-stage" style="
          transform: translate3d(0px, 0px, 0px);
          transition: all 0s ease 0s;
          width: 1124px;
        ">
        @foreach ($data->placeProperties as $index=>$property)
        <div class="owl-item" style=" width: 255.77px; margin-right: 25px; ">
          <div>
            <div id="place-properties-carousel-{{$index+1}}" class="carousel slide single-img carousel-fade"
              data-ride="carousel">
              <div class="carousel-inner">
                <button class="btn btn-primary py-0 carousel-edit-btn font-weight-light add-property"
                  data-id={{$property->id}}>
                  Add +
                </button>
                @foreach ($property->propertyFiles as $key =>$propertyFile)
                @php
                $active = $key == collect($property->propertyFiles)->keys()->first()?'active' :"";
                @endphp

                <div class="carousel-item {{$active}} ">
                  <img src="{{$propertyFile->getFile($propertyFile->id)}}" alt="..." class="rounded">
                  <div class="carousel-caption">
                    <h5>{{$property->title}}</h5>
                    <p class="single-page-price">
                      ${{$property->price}} per person
                    </p>
                  </div>
                </div>

                @endforeach

              </div>
              <a class="carousel-control-prev" href="#place-properties-carousel-{{$index+1}}" role="button"
                data-slide="prev">
                <span class="fa fa-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#place-properties-carousel-{{$index+1}}" role="button"
                data-slide="next">
                <span class="fa fa-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="owl-nav">
      <button type="button" role="presentation" class="owl-prev disabled">
        <span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next">
        <span aria-label="Next">›</span>
      </button>
    </div>
    <div class="owl-dots">
      <button role="button" class="owl-dot active">
        <span></span></button><button role="button" class="owl-dot">
        <span></span>
      </button>
    </div>
  </div>
</div>
<div class="section-footer border-bottom pb-4 mb-4">
  <button class="btn btn-primary">
    View all
  </button>
</div>
