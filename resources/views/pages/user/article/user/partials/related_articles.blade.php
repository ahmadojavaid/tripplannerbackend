<div class="page-section">
  <div class="container">
    <div class="section-head">
      <div class="section-title">
        <h2>Post Related</h2>
      </div>
      <div class="section-content">
        <div class="row">
          @foreach ($relatedArticles as $article)
          <div class="col-lg-4 col-md-6">
            <a class="blog-card" href="{{route('user.blog.article' , $article->slug)}}">
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
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
