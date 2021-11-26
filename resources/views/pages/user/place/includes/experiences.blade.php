<div class="page-section" id="experiences-scroll">
  <div class="section-head">
    <h2 class="section-title mb-4">Experiences</h2>
  </div>
  <div class="section-content">
    <div class="padding-spacing with-three owl-carousel">
      @forelse ($place->placeExperiences as $index => $experience)

      <div>
        <div id="experiences-carousel-{{$index+1}}" class="carousel slide single-img carousel-fade"
          data-ride="carousel">
          <div class="carousel-inner">
            <a href="{{route('user.experience.detail',$experience->slug)}}">
              @foreach ($experience->experienceFiles as $key =>$item)

              @php
              $active = $key == collect($experience->experienceFiles)->keys()->first()?'active' :"";
              @endphp

              <div class="carousel-item {{$active}} ">
                <img src="{{$item->getFile()}}" class="box-size-img rounded" alt="...">
                <div class="carousel-caption ">
                  <h5 class="max-1-line">{{$experience->title}}</h5>
                </div>
              </div>
              @endforeach
            </a>


          </div>
          <a class="carousel-control-prev" href="#experiences-carousel-{{$index+1}}" role="button" data-slide="prev">
            <span class="fa fa-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#experiences-carousel-{{$index+1}}" role="button" data-slide="next">
            <span class="fa fa-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
      @empty
      <p>No Experience Found</p>
      @endforelse
    </div>
  </div>
  <div class="section-footer border-b">
    <button class="btn-primary btn" href="#">View more</button>
  </div>
</div>
