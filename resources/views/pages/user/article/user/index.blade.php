@extends('layouts.user.contentLayoutMaster')
@section('content')
<div class="blog-page pt-lg-5 pt-4">
  <div class="page-section">
    <div class="container">
      <div class="section-head">
        <h2 class="section-title">
          Find all information about trip and Make your own trip to South America
        </h2>
      </div>
      <div class="section-content">
        <ul class="nav nav-tabs tabbable" id="myTab" role="tablist">

          @forelse ($countries as $id=>$name)
          @php
          $active = $id == $countries->keys()->first()?'active' :"";
          @endphp
          <li class="nav-item">
            <a class="nav-link {{$active}}" id="category-{{$id}}" data-id="{{$id}}" data-toggle="tab"
              href="category-{{$id}}" role="tab" aria-controls="category-{{$id}}" aria-selected="true">
              {{$name}}
            </a>
          </li>
          @empty
          <p>No Category Found</p>
          @endforelse
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active country-article-container" id="city1" role="tabpanel"
            aria-labelledby="city1-tab">
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
      const countryId = $('a.nav-link.active').attr('data-id');
      let url = "{{ route('user.country.articles') }}";
      if(paginationUrl !== "" && typeof paginationUrl === "string")
        url=paginationUrl;

      $.ajax({
        type:'POST',
        url:url,
        data:{
          countryId : countryId
        },
        success:function(data){
          $('.country-article-container').html(data);
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
    })
  });
</script>
@endpush
