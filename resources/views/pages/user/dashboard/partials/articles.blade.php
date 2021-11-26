<div class="page-section">
  <div class="container">
    <div class="section-head">
      <h2 class="section-title">
        Travel Guides
      </h2>
      <p class="section-description">
        Get insider tips, guides and travel advice from local experts to prepare your trip to South America.
      </p>
    </div>
    <div class="section-content">
      <div class="trips-owl owl-carousel">
        @forelse ($articles as $item)
        @include('components.user.article.card')
        @empty
        <p>No Article found</p>
        @endforelse
      </div>
    </div>
    <div class="section-footer border-b">
      @if ($articles->first())
      <a class="btn-primary btn" href="{{route('user.blog.index')}}">
        Visit our Blog
      </a>
      @endif
    </div>
  </div>
</div>
