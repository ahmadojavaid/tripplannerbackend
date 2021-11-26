@if ($paginator->hasPages())
<div class="row">
  <div class="col">
    <div class="pagination_section">

      @if ($paginator->onFirstPage())
      <a href="javscript:void(0)" class="btn disabled">
        <i class="fa fa-angle-left" aria-hidden="true"></i> first
      </a>
      @else
      <a href="{{ $paginator->previousPageUrl() }}" data-page="{{$paginator->firstItem()}}"> <i class="fa fa-angle-left"
          aria-hidden="true"></i> first</a>
      @endif

      @if($paginator->currentPage() > 3)
      <a href="{{ $paginator->url(1) }}">1</a>
      @endif
      @if($paginator->currentPage() > 4)
      <span>...</span>
      @endif


      @foreach(range(1, $paginator->lastPage()) as $i)
      @if(($i >= $paginator->currentPage() - 2) && ($i <= $paginator->currentPage() + 2))

        @if ($i == $paginator->currentPage())
        <a href="#" class="active">{{ $i }}</a>
        @else
        <a href="{{ $paginator->url($i) }}" data-page={{$i}}>{{$i}}</a>
        @endif

        @endif
        @endforeach

        @if($paginator->currentPage() < $paginator->lastPage() - 3)
          <span>...</span>

          @endif

          @if($paginator->currentPage() < $paginator->lastPage() - 2)
            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage() }}</a>

            @endif

            @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" data-page="{{$paginator->lastPage() }}" rel="next">last <i
                class="fa fa-angle-right" aria-hidden="true"></i></a>
            @else
            <a href="javascript:void(0)" class="btn disabled">last <i class="fa fa-angle-right"
                aria-hidden="true"></i></a>
            @endif
    </div>
  </div>
</div>
@endif
