<div class="section-content">
  <div class="icon-heading tinny-view">
    <h3>
      <img src="{{asset('user/images/experience-lead.png')}}" alt="" />
      <span>Experiences in </span> {{$data->title}}
    </h3>
  </div>
  @include('pages.user.trip.partials.experiences.carousel')
</div>
<div class="section-footer border-bottom pb-4 mb-4">
  <button class="btn btn-primary">
    View all
  </button>
</div>
