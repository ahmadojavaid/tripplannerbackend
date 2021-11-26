@extends('layouts.user.contentLayoutMaster')

@section('title', $article->title)

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-9">
      <div class="blog-post pt-lg-5 pt-4">
        <div class="page-section">
          <div class="container">
            <div class="section-head">
              <h2 class="section-title">
                {{$article->title}}
              </h2>
              <p class="section-description mb-3 mb-lg-5">
                {{$article->sub_title}}
              </p>
              <div class="publisher-grid d-flex justify-content-between align-items-end">
                <div>
                  <p class="pub-name">By <span>{{$article->user_name}}</span></p>
                  <p class="pub-date">
                    <span>{{$article->updated_at->format('F d Y')}}</span> <span>-</span>
                    <span>{{$article->reading_time}} Read</span>
                  </p>
                </div>
                @include('pages.user.article.user.partials.article_sharing')
              </div>
            </div>
            <div class="section-content border-bottom">
              {!!$article->description!!}
            </div>
            <div class="section-footer">
              <div class="tag-grid">
                <div class="d-flex flex-wrap">

                  @foreach ($article->activeAssociatedCountries as $country)
                  <label for="">
                    <a href={{route('user.country.detail' , $country->slug)}}>
                      {{$country->name}}
                    </a>
                  </label>
                  @endforeach
                  @foreach ($article->activeAssociatedPlaces as $place)
                  <label for="">
                    <a href={{route('user.place.detail' , $place->slug)}}>
                      {{$place->name}}
                    </a>
                  </label>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="drag-content">
        <div class="editor-card">
          <h5>Create your own experience</h5>
          <p class="more-text">More text</p>
          <a href="" class="link">Customize >></a>
        </div>
      </div>
    </div>
  </div>
</div>
@include('panels.user.newsletter')
@include('pages.user.article.user.partials.related_articles')
@endsection



@push('page-script')
<script>
  $(document).ready(function(){
    $('.section-content p>img').addClass('w-100');
    function replaceExternalHotel(hotels){
      let data = [];
      hotels.each(function(){
        data.push($(this).attr('data-slug'));
      });

      $.ajax({
        type:'POST',
        url: "{{route('user.external.hotel.list')}}",
        data:{
          data:data
        },
        success:function(data){
          data.forEach(hotel => {
            replaceData(hotel);
          });
        }
      });
    }
    const newHotels  = $('.external-hotel');
    if(newHotels.length)
      replaceExternalHotel(newHotels);


    function replaceData(hotel){
      const tag= $('a[data-slug='+hotel.slug+']');
      const hotelHtml = `<div class="media post-internal-link">
        <img class="mr-3 rounded" src="${hotel.picture}" alt="link-img">
        <div class="media-body">
          <h5 class="mt-0">${hotel.title}</h5>
          <p>${hotel.description} </p>
          <button class="btn-primary btn" href="${hotel.link}">View this hotel</button>
          </div>
        </div>`;
        tag.parent().html(hotelHtml);
    }

  });
</script>
@endpush
