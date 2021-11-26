@extends('layouts.user.contentLayoutMaster')
@section('title','Home')
@section('content')
<div class="banner">
  <div class="container">
    <div class="banner-content">
      <h2>Make your own trip to South America</h2>
      <p>Unique experiences and exclusive lodges organized by yourself</p>
{{--      <div class="form-group has-search">--}}
{{--        <span class="material-icons form-control-feedback">--}}
{{--          search--}}
{{--        </span>--}}
{{--        <input type="text" class="form-control" placeholder="Where are you going?" />--}}
{{--      </div>--}}
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <form action="{{route('user.dashboard.search')}}" id="search_form">

            <input type="hidden" id="experience_or_place" name="experience_or_place" value="-1">
            <div class="position-relative">
              <button type='submit' class='autocomplete-submit' aria-label='Search'>
                <svg aria-hidden='true' viewBox='0 0 24 24'>
                  <path d='M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z'/>
                </svg>
              </button>
              <select class="js-example-basic-single autocomplete-input" name="countries">
                <option value="" selected disabled>Where to go</option>

                @foreach ($countries as $item)
                  <option value="{{route('user.country.detail',$item->slug)}}">{{$item->name}}</option>
                @endforeach

              </select>
            </div>
          </form>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </div>
</div>

@include('pages.user.dashboard.partials.trips')
@include('pages.user.dashboard.partials.how_it_work')
@include('pages.user.dashboard.partials.about')
@include('pages.user.dashboard.partials.destination')
@include('pages.user.dashboard.partials.articles')
@include('pages.user.dashboard.partials.help')


@endsection
@push('page-script')
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

<script type="text/javascript">
  $('.js-example-basic-single').select2({
    tags: true,
    language: {
      noResults: function() {
        {
          return ' '
        }
      }
    },
  });

  $('.js-example-basic-single').on('select2:select', function (e) {
    $('#search_form').submit()
  });
</script>
@endpush
