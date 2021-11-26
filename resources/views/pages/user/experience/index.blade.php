@extends('layouts.user.contentLayoutMaster')
@section('content')
<div class="experience-index-page pt-lg-5 pt-4">
  <div class="page-section">
    <div class="container">
      <div class="section-head">
        <h2 class="section-title">
          Top Experiences in South America
        </h2>
      </div>
      <div class="section-content">
        <div class="row">
          <div class="col-12 mb-4">

            <div class="dropdown d-inline-block">
              <button class="btn btn-light py-2 px-4" href="#" role="button" id="typeOfPlaces" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Countries
              </button>
              <div class="dropdown-menu filter-dropdown" style="border-radius: 8px" aria-labelledby="typeOfPlaces">
                <a class="" href="#">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </a>
                <a class="" href="#">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </a>
                <a class="" href="#">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </a>
                <div class="d-flex justify-content-between">
                  <a href="" style="color: #000" class="font-weight-bold">Resettle</a>
                  <a href="" class="font-weight-bold">Apply</a>
                </div>
              </div>
            </div>
            <div class="dropdown d-inline-block">
              <button class="btn btn-light py-2 px-4" href="#" role="button" id="typeOfPlaces" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Type
              </button>
              <div class="dropdown-menu filter-dropdown" style="border-radius: 8px" aria-labelledby="typeOfPlaces">
                <a class="" href="#">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck1"> Categories 1</label>
                  </div>
                </a>
                <a class="" href="#">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck1">Categories 2</label>
                  </div>
                </a>
                <a class="" href="#">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck2">
                    <label class="form-check-label" for="exampleCheck1">Categories 3 </label>
                  </div>
                </a>
                <div class="d-flex justify-content-between">
                  <a href="" style="color: #000" class="font-weight-bold">Resettle</a>
                  <a href="" class="font-weight-bold">Apply</a>
                </div>
              </div>
            </div>
            <div class="dropdown d-inline-block">
              <button class="btn btn-light py-2 px-4" href="#" role="button" id="priceFilter" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                Price
              </button>
              <div class="dropdown-menu filter-dropdown" style="border-radius: 8px" aria-labelledby="priceFilter">
                <fieldset class="filter-price">
                  <label for="" class="mb-3">The average price is $3500</label>
                  <div class="price-field">
                    <input type="range" min="30" max="3500" value="30" id="lower">
                    <input type="range" min="30" max="3500" value="1000" id="upper">
                  </div>
                  <div class="price-wrap">
                    <div class="price-wrap-1">
                      <label for="one">$</label>
                      <input id="one">

                    </div>
                    <!--                                        <div class="price-wrap_line">-</div>-->
                    <div class="price-wrap-2">
                      <label for="two">$</label>
                      <input id="two">
                    </div>
                  </div>
                  <div class="d-flex justify-content-between">
                    <a href="" style="color: #000" class="font-weight-bold">Resettle</a>
                    <a href="" class="font-weight-bold">Apply</a>
                  </div>
                </fieldset>
              </div>
            </div>

          </div>
        </div>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="city1" role="tabpanel" aria-labelledby="city1-tab">
            <div class="row">
              @foreach ($experiences as $item)

              <div class="col-lg-3 col-md-4 col-6">
                <div class="ex-index-card-content" style="background:url({{$item->getFile()}}) no-repeat">
                  <div class="card-info">
                    <h3><a href="#">{{$item->title}}</a></h3>
                    <p>Price: $ <span>{{$item->price}}</span></p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            {{ $experiences->links('components.user.pagination.custom') }}
          </div>
          <div class="tab-pane fade" id="city2" role="tabpanel" aria-labelledby="city2-tab">

          </div>
          <div class="tab-pane fade" id="city3" role="tabpanel" aria-labelledby="city3-tab">
            <div class="row">
              @foreach ($experiences as $item)

              <div class="col-lg-3 col-md-4 col-6">
                <div class="ex-index-card-content" style="background:url({{$item->getFile()}}) no-repeat">
                  <div class="card-info">
                    <h3><a href="#">{{$item->title}}</a></h3>
                    <p>Price: $ <span>{{$item->price}}</span></p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            {{ $experiences->links('components.user.pagination.custom') }}

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
