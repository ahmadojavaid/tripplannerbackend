<div class="row">
  <div class="col-12">
    <div class="page-section">
      <div class="section-head">
        <h2 class="section-title mb-4">Blog posts about {{$country->name}}</h2>
        <div class="section-content">
          <div class="padding-spacing with-three owl-carousel">
            @forelse ($country->activeArticles as $item)
            @include('components.user.article.card')
            @empty
            <p>No Country Found</p>
            @endforelse
          </div>
          <a class="btn-primary btn mt-4" href="{{route('user.blog.index')}}">View all blog posts</a>
        </div>
        <div class="section-footer pb-0 border-b">

        </div>
      </div>
    </div>
  </div>
</div>
