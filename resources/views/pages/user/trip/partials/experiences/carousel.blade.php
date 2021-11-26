<div class="padding-spacing with-three owl-carousel owl-loaded owl-drag">
  <div class="owl-stage-outer">
    <div class="owl-stage" style=" transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1124px; ">
      @foreach ($data->placeExperiences as $index=>$experience)
      <div class="owl-item" style=" width: 255.77px; margin-right: 25px; ">
        <div>
          <div id="place-experiences-carousel-{{$index+1}}" class="carousel slide single-img carousel-fade"
            data-ride="carousel">
            <div class="carousel-inner">
              <button class="btn btn-primary py-0 carousel-edit-btn font-weight-light add-experience"
                data-id={{$experience->id}}>
                Add +
              </button>
              @foreach ($experience->experienceFiles as $key =>$experienceFile)
              @php
              $active = $key == collect($experience->experienceFiles)->keys()->first()?'active' :"";
              @endphp

              <div class="carousel-item {{$active}} ">
                <img src="{{$experienceFile->getFile($experienceFile->id)}}" alt="..." class="rounded">
                <div class="carousel-caption">
                  <h5>{{$experience->title}}</h5>
                  <p class="single-page-price">
                    ${{$experience->price}} per person
                  </p>
                </div>
              </div>

              @endforeach

            </div>
            <a class="carousel-control-prev" href="#place-experiences-carousel-{{$index+1}}" role="button"
              data-slide="prev">
              <span class="fa fa-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#place-experiences-carousel-{{$index+1}}" role="button"
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
