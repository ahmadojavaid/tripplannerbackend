@extends('layouts.user.contentLayoutMaster')
@section('title' , 'Trips')
@section('content')

<div class="my-trip pt-lg-5 pt-4">
  <div class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-9">
          <div class="section-head">
            <h4 class="h4">
              Trips you can customize: Make it your own to suit your style and budget
            </h4>
          </div>
          <div class="section-content">
            <div class="row">
              <div class="col-12 mb-4">

                <div class="dropdown d-inline-block">
                  <button class="btn btn-light py-2 px-4" href="#" role="button" id="typeOfPlaces"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                <div class="dropdown d-inline-block">
                  <button class="btn btn-light py-2 px-4" href="#" role="button" id="typeOfPlaces"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Duration
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
              </div>
            </div>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="country" role="tabpanel" aria-labelledby="country-tab">
                <ul class="nav nav-tabs tab-light" id="innerTab" role="tablist">
                  @forelse ($categoriesArr as $key=>$name)
                  @php
                  $active = $key == collect($categoriesArr)->keys()->first()?'active' :"";
                  @endphp
                  <li class="nav-item">
                    <a class="nav-link nav-category {{$active}}" id="category-{{$key}}" data-id="{{$key}}"
                      data-toggle="tab" href="category-{{$key}}" role="tab" aria-controls="category-{{$key}}"
                      aria-selected="true">{{$name}}</a>
                  </li>
                  @empty
                  <li>No Category Found</li>
                  @endforelse
                </ul>
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" role="tabpanel">
                    <div class="row">
                      <div class="col trip-list-container">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection




@push('page-script')
<script>
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    function loadContent(paginationUrl = ""){
      const category = $('a.nav-link.nav-category.active').attr('data-id');
      const filter = $('.nav-filter .nav-link.active').attr('aria-controls');
      let url = "{{ route('user.trip.list')}}";
      if(paginationUrl !== "" && typeof paginationUrl === "string")
        url=paginationUrl;

      $.ajax({
        type:'POST',
        url:url,
        data:{
          category : category,
          orderBy: filter,
        },
        success:function(data){
          $('.trip-list-container').html(data);
        }
      });
    }


    function handleFavourite(self){

      $.ajax({
        type:'POST',
        url: "{{route('user.trip.favourite.handle')}}",
        data:{
          id : self.attr('data-id')
        },
        success:function(data){
          if(data==="favourite")
            self.find('i.fa').attr('class' , 'fa fa-heart text-danger');
          else
            self.find('i.fa').attr('class' , 'fa fa-heart-o text-danger');
        }
      });
    }



    loadContent();
    $(document).on('click', 'a.nav-link' , loadContent);
    $(document).on('click' , '.pagination_section a' ,function(e){
      e.preventDefault();
      const self = $(this);
      if(self.attr('href').includes('page'))
      loadContent(self.attr('href'));
    });

    // =========================


    $(document).on('click' , '.display-login',function(){
      $('#login-modal').modal('show');
    });

    $(document).on('click' , '.handle-favourite',function(){
      handleFavourite($(this));
    });


  });
</script>
@endpush
