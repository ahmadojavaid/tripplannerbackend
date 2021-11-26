<div class="page-section">
  <div class="section-head">
    <h2 class="section-title">Essentials</h2>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/whereToGo.png')}}" alt="" />When to go</h3>
    </div>
    <p class="readmore">
      {{$country->when_to_go}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/sun.png')}}" alt="" />Weather</h3>
    </div>
    <p class="readmore">
      {{$country->weather}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/world.png')}}" alt="" />Getting There</h3>
    </div>
    <p class="readmore">
      {{$country->getting_there}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/currency.png')}}" alt="" />Travel Expenses</h3>
    </div>
    <p class="readmore">
      {{$country->travel_expenses}}
      <span class="readmore-link"></span>
    </p>
  </div>
  <div class="section-content">
    <div class="icon-heading">
      <h3><img src="{{asset('user/images/cleo.png')}}" alt="" />Culture</h3>
    </div>
    <p class="readmore border-b">
      {{$country->culture}}
      <span class="readmore-link"></span>
    </p>
  </div>
</div>
