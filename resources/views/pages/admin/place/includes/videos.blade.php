{!! Form::model($place, ['route' => ['admin.country.place.videos', $place->id]]) !!}
<div class="row">
  <div class="col-12">
    {{Form::fieldText('video-link-1', isset( $videoFieldData['video-link-1'] ) ? $videoFieldData['video-link-1'] : null)}}
  </div>
  <div class="col-12">
    {{Form::fieldText('video-link-2',isset($videoFieldData['video-link-2'] ) ? $videoFieldData['video-link-2'] : null)}}
  </div>
  <div class="col-12">
    {{Form::fieldText('video-link-3',isset($videoFieldData['video-link-3'] ) ? $videoFieldData['video-link-3']:null)}}
  </div>
</div>
<div class="form-group">
  <button class="btn btn-outline-primary">Store</button>
</div>
{!! Form::close() !!}
