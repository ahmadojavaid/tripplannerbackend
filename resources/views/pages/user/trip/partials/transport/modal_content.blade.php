{{--@if(isset($data))--}}

@if (isset($data->flightRoute))

<div class="form-check">
  <input type="radio" name="transport_type" id="test1" value="{{$place_id}}-{{$data->flightRoute->id}}-{{$data->flightRoute->price}}-flight" />
  <label for="test1">Flight transportation</label>
  <p class="transport-description">
    You will be picked at {{$data->departurePlace->name}} and then you will be transferred to {{$data->destinationPlace->name}}.
    Flight and transfers are included.
  </p>

  <span class="lead-text">{{$data->flightRoute->duration}} - ${{$data->flightRoute->price}}</span>
</div>
@endif

@if (isset($data->privateRoute))

  <div class="form-check">
    <input type="radio" name="transport_type" id="test1" value="{{$place_id}}-{{$data->privateRoute->id}}-{{$data->privateRoute->price}}-private"  />
    <label for="test1">Private ground transportation</label>
    <p class="transport-description">
      {{--    You Will fly from Cotopaxi National Park to Quito.--}}
      {{--    You Will be transferred to the Cotopaxi National Park--}}
      {{--    airport and met in Quito Airport, then you will be transfered to your hotel.--}}
      You will be picked at {{$data->departurePlace->name}} and then you will be transferred to {{$data->destinationPlace->name}} with private transportation. Driver and snacks are included. Since you are traveling with a private driver, you will be able to stop wherever you want as long as you want during your journey. You can also customize pick-up time and drop-off place.
    </p>

    <span class="lead-text">{{$data->privateRoute->duration}} - ${{$data->privateRoute->price}}</span>
  </div>
@endif

@if (isset($data->ownArrangeRoute))

  <div class="form-check">
    <input type="radio" name="transport_type" id="test1" value="{{$place_id}}-{{$data->ownArrangeRoute->id}}-{{$data->ownArrangeRoute->price}}-ownArrange" />
    <label for="test1">Own arrangement transportation</label>
    <p class="transport-description">
      {{--    You Will fly from Cotopaxi National Park to Quito.--}}
      {{--    You Will be transferred to the Cotopaxi National Park--}}
      {{--    airport and met in Quito Airport, then you will be transfered to your hotel.--}}
      You will arrange the transportation from {{$data->departurePlace->name}} to {{$data->destinationPlace->name}} on your own.
    </p>

    <span class="lead-text">{{$data->ownArrangeRoute->duration}} - ${{$data->ownArrangeRoute->price}}</span>
  </div>
@endif

@if (isset($data->selfDriveRoute))

  <div class="form-check">
    <input type="radio" name="transport_type" id="test1" value="{{$place_id}}-{{$data->selfDriveRoute->id}}-{{$data->selfDriveRoute->price}}-selfDrive" />
    <label for="test1">Self-drive transportation</label>
    <p class="transport-description">
      {{--    You Will fly from Cotopaxi National Park to Quito.--}}
      {{--    You Will be transferred to the Cotopaxi National Park--}}
      {{--    airport and met in Quito Airport, then you will be transfered to your hotel.--}}
      Drive from {{$data->departurePlace->name}} to {{$data->destinationPlace->name}} on your hired car and make your own way. Since you are traveling with your own hired car, you will be able to stop wherever you want as long as you want during your journey.
    </p>

    <span class="lead-text">{{$data->selfDriveRoute->duration}} - ${{$data->selfDriveRoute->price}}</span>
  </div>
@endif

@if (isset($data->privateWithEnglishRoute))

  <div class="form-check">
    <input type="radio" name="transport_type" id="test1" value="{{$place_id}}-{{$data->privateWithEnglishRoute->id}}-{{$data->privateWithEnglishRoute->price}}-privateWithEnglish"  />
    <label for="test1">Private transportation with english speaking guide</label>
    <p class="transport-description">
      You will be picked at {{$data->departurePlace->name}} and then you will be transferred to {{$data->destinationPlace->name}} with private transportation. Driver and english speaking guide are included. Since you are traveling with a private driver and guide, you will be able to stop wherever you want as long as you want during your journey. You can also customize pick-up time and drop-off place.
    </p>

    <span class="lead-text">{{$data->privateWithEnglishRoute->duration}} - ${{$data->privateWithEnglishRoute->price}}</span>
  </div>
@endif

@if (isset($data->trainRoute))

  <div class="form-check">
    <input type="radio" name="transport_type" id="test1" value="{{$place_id}}-{{$data->trainRoute->id}}-{{$data->trainRoute->price}}-train"  />
    <label for="test1">Train transportation</label>
    <p class="transport-description">
      You will be picked at {{$data->departurePlace->name}} and then you will be transferred to {{$data->destinationPlace->name}}. Train tickets and transfers are included.
    </p>

    <span class="lead-text">{{$data->trainRoute->duration}} - ${{$data->trainRoute->price}}</span>
  </div>
@endif

@if (isset($data->busRoute))

  <div class="form-check">
    <input type="radio" name="transport_type" id="test1" value="{{$place_id}}-{{$data->busRoute->id}}-{{$data->busRoute->price}}-bus"  />
    <label for="test1">Bus transportation</label>
    <p class="transport-description">
      You will be picked at {{$data->departurePlace->name}} and then you will be transferred to {{$data->destinationPlace->name}}. Bus tickets and transfers are included.
    </p>

    <span class="lead-text">{{$data->busRoute->duration}} - ${{$data->busRoute->price}}</span>
  </div>
@endif

@if (isset($data->airportRoute))

<div class="form-check">

  <input type="radio" name="transport_type" id="test2" value="{{$place_id}}-{{$data->airportRoute->id}}-{{$data->airportRoute->price}}-airport" />
  <label for="test2">Airport Transfer</label>
  <p class="transport-description">
    You will be picked at the closer airport and transferred to your property in {{$data->destinationPlace->name}}.
  </p>
  <span class="lead-text">{{$data->airportRoute->duration}} - ${{$data->airportRoute->price}}</span>

</div>

@endif

{{--@endif--}}
{{--<div class="form-check">--}}
{{--  <input type="radio" id="test3" />--}}
{{--  <label for="test4">Arrange it by myself</label>--}}
{{--  <p class="transport-description">--}}
{{--    I want to arrange the transportation by myself.--}}
{{--  </p>--}}
{{--</div>--}}
