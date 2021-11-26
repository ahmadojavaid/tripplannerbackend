<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle date-above-place" data-toggle="collapse" href="#collapse-{{$data->id}}">
        20 May ´21 - 22 May ´21
      </a>
    </h4>
  </div>
  <div id="collapse-{{$data->id}}" class="panel-collapse collapse in show">
    <div class="panel-body">
      <div class="section-content">
        <form action="">
          <div class="item-counter">
            <div class="value-button decrease-nights" id="decrease" >
              -
            </div>
{{--            <div class="value-button increase-nights" id="decrease" onclick="decreaseValue()" value="Decrease Value">--}}
{{--              ---}}
{{--            </div>--}}
            <div class="no_of_nights_class">
              <input class="no_of_nights" type="number" id="number" name="nights[]" value="2" />
              <span>Nights</span>
            </div>
            <div class="value-button increase-nights" id="increase" >
              +
            </div>
{{--            <div class="value-button decrease-nights" id="increase" onclick="increaseValue()" value="Increase Value">--}}
{{--              +--}}
{{--            </div>--}}
          </div>
        </form>
      </div>

      <div class="section-content border-bottom pb-4 mb-4">
        <div class="icon-heading tinny-view">
          <h3>
            <img src="{{asset('user/images/map-pin.png')}}" alt="" />
            <span>Your trip begins in</span> {{$data->name}}
          </h3>
          <button class="right-bottom btn btn-light py-1">
            Edit
          </button>
        </div>
        <div class="icon-head-content">
          <p class="readmore">
            {{$data->short_description}}
            <span class="readmore-link"></span>
          </p>
        </div>
      </div>

      <div class="section-content border-bottom pb-4 mb-4">
        <div class="icon-heading tinny-view">
          <h3>
            <img src="{{asset('user/images/airport.png')}}" alt="" />
            <span class="transport-{{$data->id}}">Airport Transfer</span>
          </h3>
          <button class="right-bottom btn btn-light py-1 handle-transport" data-id="{{$data->id}}">
{{--          <button class="right-bottom btn btn-light py-1 handle-transport" data-id="{{1}}">--}}
            Edit
          </button>
        </div>
        <div class="icon-head-content readmore">
          <p>
{{--            You Will be met in Quito Airport, then you--}}
{{--            will be transfered to your hotel in Cotopaxi--}}
{{--            National Park.--}}
          </p>
          <p class="lead-text">
{{--            1 hour - $60 per person--}}
          </p>
          <p>
{{--            You Will be met in Quito Airport, then you--}}
{{--            will be transfered to your hotel in Cotopaxi--}}
{{--            National Park.--}}
          </p>
          <p>
{{--            You Will be met in Quito Airport, then you--}}
{{--            will be transfered to your hotel in Cotopaxi--}}
{{--            National Park.--}}
          </p>
          <p>
{{--            You Will be met in Quito Airport, then you--}}
{{--            will be transfered to your hotel in Cotopaxi--}}
{{--            National Park.--}}
          </p>

{{--          <span class="readmore-link"></span>--}}
        </div>
      </div>


      <div class="{{$data->id}}-place-property-section">
        @include('pages.user.trip.partials.properties.add')
      </div>
      <div class="{{$data->id}}-place-experience-section">
        @include('pages.user.trip.partials.experiences.add')
      </div>
    </div>

  </div>
</div>
