@extends('layouts.user.contentLayoutMaster')
@section('content')
  <div class="trip-view-page mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="tripViewsFeatureImage">
            <a class="btn btn-secondary font-weight-normal"> <i class="fa fa-map-marker mr-1"></i> Show map</a>
            <img src="https://unsplash.it/600.jpg?image=254" alt="">
{{--            @php--}}
{{--              $image_count = 0;--}}
{{--            @endphp--}}
{{--            @foreach ($usertrip->tripCountry as $p)--}}

{{--              @if(isset($p->countryFile))--}}
{{--                @foreach($p->countryFile as $item)--}}
{{--                  @if($image_count==0)--}}
{{--                  <img src="{{$item->getFile()}}" alt="">--}}

{{--                    @php--}}
{{--                      $image_count++;--}}
{{--                    @endphp--}}
{{--                  @endif--}}
{{--                @endforeach--}}
{{--              @endif--}}
{{--            @endforeach--}}


          </div>
          <div class="trip-stats">
            <div>
              <label for="">Duration</label>
              <span>{{$no_of_days}} Days</span>
            </div>
            <div>
              <label for="">Places Visited</label>
              <span>{{$places_count}} Place</span>
            </div>
            <div>
              <label for="">From </label>
              <span>{{$first_place->title}}</span>
            </div>
            <div>
              <label for="">To</label>
              <span>{{$last_place->title}}</span>
            </div>
          </div>
          <div class="page-section"  id="overview-scroll">
            <div class="section-content">
              <div class="icon-heading">
                <h3 class="text-gray">Where you´ll be</h3>
              </div>
              <div class="overFlow-carousel">


{{--                    <a href="{{$item->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="{{$item->getFile()}}" class="img-fluid rounded">--}}
{{--                    </a>--}}

                @foreach ($usertrip->tripPlaces as $tp)

                <div class="d-inline-block mr-2" style="margin-bottom: 15px">
                  <div id="carouselExampleIndicators1{{$tp->id}}" class="carousel slide single-img carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                      @foreach($tp->placeFiles as $key=>$itemx)
                        <div class="carousel-item {{($key==0)?'active':''}}  ">
                        <img src="{{$itemx->getFile()}}" alt="...">
                        <div class="carousel-caption  ">
                          <h5>{{$tp->title}}</h5>
                        </div>
                      </div>
                      @endforeach

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators1{{$tp->id}}" role="button" data-slide="prev">
                      <span class="fa fa-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators1{{$tp->id}}" role="button" data-slide="next">
                      <span class="fa fa-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
{{--                  @endforeach--}}
                @endforeach
{{--                <div class="d-inline-block mr-2" style="margin-bottom: 15px">--}}
{{--                  <div id="carouselExampleIndicators2" class="carousel slide single-img carousel-fade" data-ride="carousel">--}}
{{--                    <div class="carousel-inner">--}}
{{--                      <div class="carousel-item active ">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption  ">--}}
{{--                          <h5>Galaspa Island</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="carousel-item">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption  ">--}}
{{--                          <h5>Galaspa Island 2</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="carousel-item">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption">--}}
{{--                          <h5>Galaspa Island 3</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                    <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">--}}
{{--                      <span class="fa fa-chevron-left" aria-hidden="true"></span>--}}
{{--                      <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                    <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">--}}
{{--                      <span class="fa fa-chevron-right" aria-hidden="true"></span>--}}
{{--                      <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="d-inline-block mr-2" style="margin-bottom: 15px">--}}
{{--                  <div id="carouselExampleIndicators3" class="carousel slide single-img carousel-fade" data-ride="carousel">--}}
{{--                    <div class="carousel-inner">--}}
{{--                      <div class="carousel-item active ">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption  ">--}}
{{--                          <h5>Galaspa Island</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="carousel-item">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption  ">--}}
{{--                          <h5>Galaspa Island 2</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="carousel-item">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption">--}}
{{--                          <h5>Galaspa Island 3</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                    <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-slide="prev">--}}
{{--                      <span class="fa fa-chevron-left" aria-hidden="true"></span>--}}
{{--                      <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                    <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-slide="next">--}}
{{--                      <span class="fa fa-chevron-right" aria-hidden="true"></span>--}}
{{--                      <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="d-inline-block mr-2" style="margin-bottom: 15px">--}}
{{--                  <div id="carouselExampleIndicators4" class="carousel slide single-img carousel-fade" data-ride="carousel">--}}
{{--                    <div class="carousel-inner">--}}
{{--                      <div class="carousel-item active ">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption  ">--}}
{{--                          <h5>Galaspa Island</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="carousel-item">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption  ">--}}
{{--                          <h5>Galaspa Island 2</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                      <div class="carousel-item">--}}
{{--                        <img src="images/ex-index-trip.png" alt="...">--}}
{{--                        <div class="carousel-caption">--}}
{{--                          <h5>Galaspa Island 3</h5>--}}
{{--                        </div>--}}
{{--                      </div>--}}
{{--                    </div>--}}
{{--                    <a class="carousel-control-prev" href="#carouselExampleIndicators4" role="button" data-slide="prev">--}}
{{--                      <span class="fa fa-chevron-left" aria-hidden="true"></span>--}}
{{--                      <span class="sr-only">Previous</span>--}}
{{--                    </a>--}}
{{--                    <a class="carousel-control-next" href="#carouselExampleIndicators4" role="button" data-slide="next">--}}
{{--                      <span class="fa fa-chevron-right" aria-hidden="true"></span>--}}
{{--                      <span class="sr-only">Next</span>--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
              </div>
            </div>
            <div class="section-content">
              <div class="icon-heading">
                <h3 class="text-gray">Where you will be hosted</h3>
              </div>
              <div class="images-grid">
                <div class="container">
                  <div class="row overFlow-carousel">
                    @foreach ($usertrip->tripProperties as $p)
                      @foreach($p->propertyFiles as $item)
                    <a href="{{$item->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">
                      <img src="{{$item->getFile()}}" class="img-fluid rounded">
                    </a>
                    @endforeach
                    @endforeach
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
                  </div>
                </div>
              </div>
            </div>
            @php
              $days = 0;
            @endphp
            <div class="section-content">
              <div class="icon-heading">
                <h3 class="text-gray">What you´ll do</h3>
              </div>
              <div class="images-grid">
                <div class="container">
                  <div class="row overFlow-carousel">

{{--                        <a href="{{$item->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                          <img src="{{$item->getFile()}}" class="img-fluid rounded">--}}
{{--                        </a>--}}

                    @foreach ($usertrip->tripExperiences as $te)
                      @foreach($te->experienceFiles as $itemxx)
                    <a href="{{$itemxx->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">
                      <img src="{{$itemxx->getFile()}}" class="img-fluid rounded">
                    </a>
                      @endforeach
                    @endforeach
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4 mr-2 p-0">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
                  </div>
                </div>
              </div>
            </div>
{{--            Places and hotels section start--}}

            @foreach($usertrip->tripPlaces as $key=> $trip_place)

              @php
                $place_images_counter = 0;
              @endphp

            <div class="section-content">
              <div class="viewTripCard media align-items-center">
                @foreach($tp->placeFiles as $keyx=>$itemx)
                  @if($place_images_counter==0)
                    <img src="{{$itemx->getFile()}}" alt="">
                    @php
                      $place_images_counter++;
                    @endphp
                  @endif
                @endforeach

                <div class="media-body">
                  <h5>
                    @if($key==0)
                    <span class="text-gray">Days 1 - {{$trip_place->no_of_nights}}: </span><span class="lead-text">{{$trip_place->title}}</span>
                    @else
                      <span class="text-gray">Days {{$days+1}} - {{$days+$trip_place->no_of_nights}}: </span><span class="lead-text">{{$trip_place->title}}</span>
                    @endif

                  </h5>
                  <p class="max-5-line">
                    {{$trip_place->description}}
                  </p>
                  <p>
                    <b>Transportation: </b> {{$trip_place->transport_title}}
                  </p>
                  <a href="{{route('user.my-trip-place-edit',['trip_id' => $usertrip->id, 'place_id' => $trip_place->place_id])}}"><button class="btn btn-primary">Edit your trip</button></a>
                </div>
              </div>
              <div class="viewTripCard-alt">
                @foreach($usertrip->tripProperties as $key=> $property)
                  @if($property->place_id==$trip_place->place_id)
                    <p>
                      <b>Hotel:</b> {{$property->title}}
                    </p>
                    <p class="max-2-line"> {{$property->description}}.</p>
                  @endif
                @endforeach

                <div class="images-grid">
                  <div class="row">
                    @php
                    $image_count = 0;
                    @endphp
                    @foreach ($usertrip->tripProperties as $p)
                      @if($p->place_id==$trip_place->place_id)
                      @foreach($p->propertyFiles as $item)
                        @if($image_count<3)

                        <a href="{{$item->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                          <img src="{{$item->getFile()}}" class="img-fluid rounded">
                        </a>
                          @php
                            $image_count++;
                          @endphp
                        @endif
                      @endforeach
                      @endif
                    @endforeach

{{--                    <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
                  </div>
                </div>
              </div>
              <div class="viewTripCard-alt">
                @foreach($usertrip->tripExperiences as $key=> $experience)
                  @if($experience->place_id==$trip_place->place_id)
                <p>
                  <b>Activity:</b> {{$experience->title}}
                </p>
                <p class="max-2-line"> {{$experience->description}}</p>
                  @endif
                @endforeach
                <div class="images-grid">
                  <div class="row">
                    @php
                      $exp_image_count = 0;
                    @endphp
                    @foreach ($usertrip->tripExperiences as $te)
                      @if($te->place_id==$trip_place->place_id)
                      @foreach($te->experienceFiles as $itemxx)
                        @if($exp_image_count<3)
                        <a href="{{$itemxx->getFile()}}" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">
                          <img src="{{$itemxx->getFile()}}" class="img-fluid rounded">
                        </a>
                          @php
                            $exp_image_count++;
                          @endphp
                        @endif
                      @endforeach
                      @endif
                    @endforeach
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
                  </div>
                </div>
              </div>
            </div>

{{--              @if($key>0)--}}
                @php
                  $days = $days+ $trip_place->no_of_nights;
                @endphp
{{--              @endif--}}
            @endforeach
            {{--            Places and hotels section end--}}
{{--            <div class="section-content">--}}
{{--              <div class="viewTripCard media align-items-center">--}}
{{--                <img src="images/trip-view-feature.png" alt="">--}}
{{--                <div class="media-body">--}}
{{--                  <h5>--}}
{{--                    <span class="text-gray">Days 4 - 5: </span><span class="lead-text">Cotopaxi</span>--}}
{{--                  </h5>--}}
{{--                  <p class="max-5-line">--}}
{{--                    Make your own trip to South America vvvvvvvvvvvvvvvvvvvvvvvv vvvv uin ur own trip to South America vvvv ur own trip to South America vvvv.--}}
{{--                    Make your own trip to South America vvvvvvvvvvvvvvvvvvvvvvvv vvvv uin ur own trip to South America vvvv ur own trip to South America vvvv.--}}
{{--                  </p>--}}
{{--                  <p>--}}
{{--                    <b>Transportation: </b> Airport transfer--}}
{{--                  </p>--}}
{{--                  <button class="btn btn-primary">Edit your trip</button>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="viewTripCard-alt">--}}
{{--                <p>--}}
{{--                  <b>Hotel:</b> Mama Cuchara--}}
{{--                </p>--}}
{{--                <p class="max-2-line"> Descripción del hotel va aquí, para que se vea bien.</p>--}}

{{--                <div class="images-grid">--}}
{{--                  <div class="row">--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--              <div class="viewTripCard-alt">--}}
{{--                <p>--}}
{{--                  <b>Activity:</b> Activity Name--}}
{{--                </p>--}}
{{--                <p class="max-2-line"> Descripción del hotel va aquí, para que se vea bien.</p>--}}
{{--                <div class="images-grid">--}}
{{--                  <div class="row">--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=254" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=254" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=255" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=255" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                    <a href="https://unsplash.it/1200/768.jpg?image=256" data-toggle="lightbox" data-gallery="gallery" class="col-md-4">--}}
{{--                      <img src="https://unsplash.it/600.jpg?image=256" class="img-fluid rounded">--}}
{{--                    </a>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
            <div class="section-content">
              <div>
                <div class="icon-heading">
                  <h3 class="text-gray">Good to Know</h3>
                  <h3 class="lead-text">Cancellation Policy</h3>
                </div>
                <p class="readmore">
                  to South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts nji nuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinu
                  <span class="readmore-link"></span>
                </p>
                <div class="section-footer border-b p-0"></div>
              </div>

              <div class="border-b pb-3 mb-3">
                <div class="icon-heading">
                  <h3 class="lead-text">Itinerary</h3>
                </div>
                <p class="readmore">
                  to South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts nji nuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinu
                  <span class="readmore-link"></span>
                </p>
                <div class="section-footer border-b p-0"></div>
              </div>

              <div>
                <div class="icon-heading">
                  <h3 class="lead-text">What´s Included</h3>
                </div>
                <p class="readmore">
                  to South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts nji nuto South Amer Make your own tri Make your own Make your own jbjn Make your own
                  trip to South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju b Make your own trip to South Amer.
                  hijk ijk hgbjhnkml gujhn
                  hikhnik guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx rrerts njinu
                  <span class="readmore-link"></span>
                </p>
                <div class="section-footer border-b p-0"></div>
              </div>
            </div>
            <div class="page-section" id="trip-scroll">
              <div class="section-head">
                <h2 class="section-title mb-4">Related Trips</h2>
              </div>
              <div class="section-content">
                <div class="trips-owl with-three large-img owl-carousel">
                  <div>
                    <div class="trip-highlight-card">
                      <div class="card-head">
                        <img src="images/trip-card-img.png" alt="">
                        <div class="map">
                          <!--                                        <div class="map-head corner-bottom-both-bevel">-->
                          <!--                                            <span>Tiptop 2</span> |-->
                          <!--                                            <span>5 Days</span>-->
                          <!--                                        </div>-->
                          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13597.083266021025!2d74.3235535!3d31.571620600000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1595998671122!5m2!1sen!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                      </div>
                      <div class="card-content">
                        <h3>1 nights in Galapagos</h3>
                        <p>
                          With this tour you Will be able to visit the
                          Galapagos Islands and discover off beaten track.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="trip-highlight-card">
                      <div class="card-head">
                        <img src="images/trip-card-img.png" alt="">
                        <div class="map">
                          <!--                                        <div class="map-head corner-bottom-both-bevel">-->
                          <!--                                            <span>Tiptop 2</span> |-->
                          <!--                                            <span>5 Days</span>-->
                          <!--                                        </div>-->
                          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13597.083266021025!2d74.3235535!3d31.571620600000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1595998671122!5m2!1sen!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                      </div>
                      <div class="card-content">
                        <h3>1 nights in Galapagos</h3>
                        <p>
                          With this tour you Will be able to visit the
                          Galapagos Islands and discover off beaten track.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="trip-highlight-card">
                      <div class="card-head">
                        <img src="images/trip-card-img.png" alt="">
                        <div class="map">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13597.083266021025!2d74.3235535!3d31.571620600000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1595998671122!5m2!1sen!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                      </div>
                      <div class="card-content">
                        <h3>1 nights in Galapagos</h3>
                        <p>
                          With this tour you Will be able to visit the
                          Galapagos Islands and discover off beaten track.
                        </p>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="trip-highlight-card">
                      <div class="card-head">
                        <img src="images/trip-card-img.png" alt="">
                        <div class="map">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13597.083266021025!2d74.3235535!3d31.571620600000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1595998671122!5m2!1sen!2s" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                      </div>
                      <div class="card-content">
                        <h3>1 nights in Galapagos</h3>
                        <p>
                          With this tour you Will be able to visit the
                          Galapagos Islands and discover off beaten track.
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="section-footer border-0 p-0">
                <button class="btn-primary btn mr-lg-3 mr-2 mb-2" href="#">View all highlighted trips</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="drag-content mt-0">
            <div class="editor-card mw-100">
              <h5 class="text-blue">{{$usertrip->title}}</h5>
              <p class="lead-text">By {{$usertrip->tripUser->getNameAttribute()}}</p>
              <p class="more-text mb-2">
                {{$usertrip->description}}
              </p>
              <button class="btn-secondary btn mb-lg-3 mb-3 d-block"><a href="{{route('user.my-trip-intro-edit',$usertrip->id)}}">Edit Introduction</a> </button>
            </div>
          </div>
          <div class="advantage-card">
            <p>Say something</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class=" mt-5">
    <div class="mobile-bottom-bar">
      <div class="header-price">
        <p class="lead-text"> <span>50$</span> per person </p>
        <p class="head-date"> 20 May 21 - 22 May 2021 </p>
      </div>
      <div>
        <button class="btn-primary btn mr-2" href="#">Edit Trip</button>
        <button class="btn-primary btn" href="#">Enquire</button>
      </div>
    </div>
  </div>


@endsection
@push('page-script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.js"></script>
  <script src="{{asset('leaflet/leaflet.polylineDecorator.js')}}"></script>
  <script src="{{asset('leaflet/example.js')}}"></script>
  <script>
    $(document).ready(function(){

      init("map-1");
      init("map-2");
    });
  </script>
@endpush
@push('page-script')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.1/leaflet.css" />
@endpush
