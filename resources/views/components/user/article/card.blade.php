<div>
  <a class="trip-highlight-card" href="{{route('user.blog.article',$item->slug)}}">
    <div class="card-head">
      <img src="{{$item->getFile()}}" alt="" />
    </div>
    <div class="card-content">
      <h3>{{$item->title}}</h3>
      <p>
        {{$item->sub_title}}
      </p>
    </div>
  </a>
</div>
