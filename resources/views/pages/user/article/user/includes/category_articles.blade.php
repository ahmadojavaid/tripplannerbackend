@foreach ($data as $article)
<div class="col-lg-4 col-md-6">
  <div class="blog-card">
    <a href="{{route('user.blog.article',$article->slug)}}">
      <div class="card-head">
        <img src="{{$article->getFile()}}" alt="">
      </div>
      <div class="card-content">
        <h3>{{$article->title}}</h3>
        <p>
          {{$article->sub_title}}
        </p>
      </div>
    </a>
  </div>
</div>
@endforeach
