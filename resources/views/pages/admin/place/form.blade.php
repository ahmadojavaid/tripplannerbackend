<div class="row">
  <div class="col-md-2 col-sm-12">
    <ul class="nav nav-pills flex-column">
      <li class="nav-item">
        <a class="nav-link active" id="stacked-pill-1" data-toggle="pill" href="#vertical-pill-1" aria-expanded="true">
          Basic
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if(!isset($place)) disabled @endif" id="stacked-pill-images" data-toggle="pill"
          href="#vertical-pill-images" aria-expanded="true">
          Images
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  @if(!isset($place)) disabled @endif" id="stacked-pill-2" data-toggle="pill"
          href="#vertical-pill-2" aria-expanded="false">
          Essentials
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  @if(!isset($place)) disabled @endif" id="stacked-pill-videos" data-toggle="pill"
          href="#vertical-pill-videos" aria-expanded="false">
          Videos
        </a>
      </li>
    </ul>
  </div>
  <div class="col-md-10 col-sm-12">
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="vertical-pill-1" aria-labelledby="stacked-pill-1"
        aria-expanded="true">
        @include('pages.admin.place.includes.basic_information')
      </div>
      @isset($place)

      <div role="tabpanel" class="tab-pane" id="vertical-pill-images" aria-labelledby="stacked-pill-images"
        aria-expanded="true">
        @include('pages.admin.place.includes.place_images')
      </div>
      <div class="tab-pane" id="vertical-pill-2" role="tabpanel" aria-labelledby="stacked-pill-2" aria-expanded="false">
        @include('pages.admin.place.includes.essentials')
      </div>
      <div class="tab-pane" id="vertical-pill-videos" role="tabpanel" aria-labelledby="stacked-pill-videos"
        aria-expanded="false">
        @include('pages.admin.place.includes.videos')
      </div>
      @endisset

    </div>
  </div>
</div>
