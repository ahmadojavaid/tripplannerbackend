<div class="page-section places-added">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-content">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a class="accordion-toggle date-above-place" data-toggle="collapse" href="#collapse-">
                    {{$start_date}}-{{$end_date}}
                  </a>
                </h4>
              </div>
              <div id="collapse-" class="panel-collapse collapse in show">
                <div class="panel-body">
                  <div class="section-content">
                    <form action="">
                      <div class="item-counter">
                        <div class="value-button decrease-nights" id="decrease" >
                          -
                        </div>
                        <div class="no_of_nights_class">
                          <input class="no_of_nights" type="number" id="number" name="nights[]" value="{{$usertrip->tripPlaces[0]->no_of_nights}}" />
                          <span>Nights</span>
                        </div>
                        <div class="value-button increase-nights" id="increase" >
                          +
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="section-content border-bottom pb-4 mb-4">
                    <div class="icon-heading tinny-view">
                      <h3>
                        <img src="{{asset('user/images/map-pin.png')}}" alt="" />
                        <span>Your trip begins in {{$usertrip->tripPlaces[0]->title}}</span>
                      </h3>
                    </div>
                    <div class="icon-head-content">
                      <p class="readmore">
                        {{$usertrip->tripPlaces[0]->description}}
                        <span class="readmore-link"></span>
                      </p>
                    </div>
                  </div>
                  <div class="section-content border-bottom pb-4 mb-4">
                    <div class="icon-heading tinny-view">
                      <h3>
                        <img src="{{asset('user/images/airport.png')}}" alt="" />
                        <span class="transport-">{{$usertrip->tripPlaces[0]->transport_title}}</span>
                      </h3>
                    </div>
                    <div class="icon-head-content">
                      <p class="readmore">
                        The Transportation fee for this tour is {{$usertrip->tripPlaces[0]->transport_price}}
                        <span class="readmore-link"></span>
                      </p>
                    </div>
                  </div>
                  @if(!empty($usertrip->tripExperiences[0]))
                  <div class="section-content border-bottom pb-4 mb-4">
                    <div class="icon-heading tinny-view">
                      <h3>
                        <img src="{{asset('user/images/experience-lead.png')}}" alt="">
                        <span>Experiences in </span> {{$usertrip->tripExperiences[0]->title}}
                      </h3>
                      <button class="right-bottom btn btn-light py-1">Edit</button>
                    </div>
                    <div class="icon-head-content readmore">
                      <span class="readmore-link"></span>
                    </div>
                    <div class="info-with-images">
                      <h3>{{$usertrip->tripExperiences[0]->title}}</h3>
                      <p>Price: <span>{{$usertrip->tripExperiences[0]->experience_price}}$</span> per night, per person</p>
                      <div class="row mt-3">
                        @foreach ($usertrip->tripExperiences[0]->experienceFiles->take(4) as $file)
                          <a href="{{ $file->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-3 col-sm-6 col-6">
                            <img src="{{$file->getFile()}}" class="img-fluid rounded">
                          </a>
                        @endforeach
                      </div>
                    </div>
                  </div>


                  {{-- Experiences list --}}
                  <div class="section-footer border-bottom pb-4 mb-4">
                    <button class="btn btn-primary">
                      View all
                    </button>
                  </div>
                </div>
                @endif
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
