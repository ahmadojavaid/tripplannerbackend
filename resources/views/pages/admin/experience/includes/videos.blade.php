{!! Form::model($experience, ['route' => ['admin.experience.videos', $experience->id]]) !!}
<div class="row">
  <div class="col-12">
    {{Form::fieldText('video-link', isset($videoFieldData['video-link']) ? $videoFieldData['video-link']:null  )}}
    <div class="d-flex flex-column mb-1">
      <label for="">Hint:</label>
      <label for="">https://www.youtube.com/embed/kJaMATuaWOs</label>
      <label for="">https://player.vimeo.com/video/442118534</label>
    </div>
  </div>
</div>
<div class="form-group">
  <button class="btn btn-outline-primary">Store</button>
</div>
{!! Form::close() !!}
