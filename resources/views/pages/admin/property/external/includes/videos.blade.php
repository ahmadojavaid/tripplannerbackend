{!! Form::model($property, ['route' => ['admin.property.videos', $property->id]]) !!}
<div class="row">
  <div class="col-12">
    {{Form::fieldText('video-link', isset($videoFieldData['video-link']) ? $videoFieldData['video-link']:null  )}}
  </div>
</div>
<div class="form-group">
  <button class="btn btn-outline-primary">Store</button>
</div>
{!! Form::close() !!}
