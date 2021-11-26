<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" href="#collapseOne">
        20 May ´21 - 22 May ´21
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse collapse in show">
    <div class="panel-body">
      <div class="section-content">
        <form action="">
          <div class="item-counter">
            <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">
              -
            </div>
            <div class="">
              <input type="number" id="number" value="0" />
              <span>Nights</span>
            </div>
            <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">
              +
            </div>
          </div>
        </form>
      </div>

      <div class="section-content border-bottom pb-4 mb-4">
        <div class="icon-heading tinny-view">
          <h3>
            <img src="{{asset('user/images/map-pin.png')}}" alt="" />
            <span>Your trip begins in</span> Cotopaxi
            National Park
          </h3>
          <button class="right-bottom btn btn-light py-1">
            Edit
          </button>
        </div>
        <div class="icon-head-content">
          <p class="readmore">
            to South Amer Make your own tri Make your
            own Make your own jbjn Make your own trip to
            South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju
            b Make your own trip to South Amer. hijk ijk
            hgbjhnkml gujhn hikhnik guhijnmkjbhvcg
            dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx
            rrerts njinuto South Amer Make your own tri
            Make your own Make your own jbjn Make your
            own trip to South Amer. cgvhbjjkklñ hijk ijk
            vhybj uhjju b Make your own trip to South
            Amer. hijk ijk hgbjhnkml gujhn hikhnik
            guhijnmkjbhvcg dfgvhbjnhgftd fcfv vhbjnhv yg
            gtcgcg xcfx rrerts njinuto South Amer Make
            your own tri Make your own Make your own
            jbjn Make your own trip to South Amer.
            cgvhbjjkklñ hijk ijk vhybj uhjju b Make your
            own trip to South Amer. hijk ijk hgbjhnkml
            gujhn hikhnik guhijnmkjbhvcg dfgvhbjnhgftd
            fcfv vhbjnhv yg gtcgcg xcfx rrerts nji nuto
            South Amer Make your own tri Make your own
            Make your own jbjn Make your own trip to
            South Amer. cgvhbjjkklñ hijk ijk vhybj uhjju
            b Make your own trip to South Amer. hijk ijk
            hgbjhnkml gujhn hikhnik guhijnmkjbhvcg
            dfgvhbjnhgftd fcfv vhbjnhv yg gtcgcg xcfx
            rrerts njinu
            <span class="readmore-link"></span>
          </p>
        </div>
      </div>

      <div class="section-content border-bottom pb-4 mb-4">
        <div class="icon-heading tinny-view">
          <h3>
            <img src="{{asset('user/images/airport.png')}}" alt="" />
            <span></span> Airport Transfer
          </h3>
          <button class="right-bottom btn btn-light py-1">
            Edit
          </button>
        </div>
        <div class="icon-head-content readmore">
          <p>
            You Will be met in Quito Airport, then you
            will be transfered to your hotel in Cotopaxi
            National Park.
          </p>
          <p class="lead-text">
            1 hour - $60 per person
          </p>
          <p>
            You Will be met in Quito Airport, then you
            will be transfered to your hotel in Cotopaxi
            National Park.
          </p>
          <p>
            You Will be met in Quito Airport, then you
            will be transfered to your hotel in Cotopaxi
            National Park.
          </p>
          <p>
            You Will be met in Quito Airport, then you
            will be transfered to your hotel in Cotopaxi
            National Park.
          </p>

          <span class="readmore-link"></span>
        </div>
      </div>


      @include('pages.user.trip.partials.properties.add')
      @include('pages.user.trip.partials.experiences.add')

    </div>
    <div class="section-footer border-bottom pb-4 mb-4">
      <button class="btn btn-primary">
        View all
      </button>
    </div>

    <div class="section-content">
      <div class="icon-heading tinny-view">
        <h3>
          <span>Experiences in </span> Cotopaxi
          National Park
        </h3>
      </div>
      <div class="padding-spacing with-three owl-carousel">
        <div>
          <div id="carouselExampleIndicators2" class="carousel slide single-img carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              <button class="btn btn-primary py-0 carousel-edit-btn font-weight-light">
                Add +
              </button>
              <div class="carousel-item active">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
              <span class="fa fa-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
              <span class="fa fa-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div>
          <div id="carouselExampleIndicators2" class="carousel slide single-img carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              <button class="btn btn-primary py-0 carousel-edit-btn font-weight-light">
                Add +
              </button>
              <div class="carousel-item active">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
              <span class="fa fa-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
              <span class="fa fa-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div>
          <div id="carouselExampleIndicators2" class="carousel slide single-img carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              <button class="btn btn-primary py-0 carousel-edit-btn font-weight-light">
                Add +
              </button>
              <div class="carousel-item active">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
              <span class="fa fa-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
              <span class="fa fa-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <div>
          <div id="carouselExampleIndicators2" class="carousel slide single-img carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              <button class="btn btn-primary py-0 carousel-edit-btn font-weight-light">
                Add +
              </button>
              <div class="carousel-item active">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="{{asset('user/images/El-Porvenir-Living-room-1.png')}}" alt=" ..." />
                <div class="carousel-caption">
                  <h5>Galaspa Island</h5>
                  <p class="single-page-price">
                    $150 per person
                  </p>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
              <span class="fa fa-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
              <span class="fa fa-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="section-footer border-bottom pb-4 mb-4">
      <button class="btn btn-primary">
        View all
      </button>
    </div>

  </div>
</div>
