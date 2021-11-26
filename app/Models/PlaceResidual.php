<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
class PlaceResidual extends Model
{
  use SoftDeletes;
  const FIELD_1 = 'why-to-go-there',
    FIELD_2 = 'how-to-get-there',
    FIELD_3 = 'how-to-fully-enjoy-it';


  const
    VIDEO_LINK_1 = 'video-link-1',
    VIDEO_LINK_2 = 'video-link-2',
    VIDEO_LINK_3 = 'video-link-3';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'slug', 'value', 'place_id', 'created_at', 'updated_at'
  ];

  protected $dates = ['deleted_at'];

  public static function getData($id)
  {
    return self::where([
      'place_id' => $id,
    ])->whereIn('slug', self::getFields())->get();
  }



  public static function getVideoData($id)
  {
    return self::where([
      'place_id' => $id,
    ])->whereIn('slug', self::getVideoFields())->get();
  }

  public static function getFields()
  {
    return [
      self::FIELD_1,
      self::FIELD_2,
      self::FIELD_3
    ];
  }

  public static function getVideoFields()
  {
    return [
      self::VIDEO_LINK_1,
      self::VIDEO_LINK_2,
      self::VIDEO_LINK_3,
    ];
  }


  public static function handleData($array, $id)
  {

    $data = self::getData($id);
    $values  = [];
    if ($data->first()) {
      foreach ($data as $key => $value) {
        $values[]  = [
          'value' => $array[$value->slug],
          'slug' => $value->slug,
          'place_id' => $id,
          'id' => $value->id,
          'updated_at' => Carbon::now()
        ];
      }

      \Batch::update(new self, $values, 'id');
    } else {
      foreach ($array as $key => $value) {
        $values[] = [
          $key,
          $id,
          $value,
          Carbon::now(),
          Carbon::now()
        ];
      }

      \Batch::insert(new self, ['slug',  'place_id', 'value', 'created_at',  'updated_at'], $values, 3);
    }
    return $values;
  }


  public static function handleVideoData($array, $id)
  {

    $data = self::getVideoData($id);
    $values  = [];
    if ($data->first()) {
      foreach ($data as $key => $value) {
        $values[]  = [
          'value' => $array[$value->slug],
          'slug' => $value->slug,
          'place_id' => $id,
          'id' => $value->id,
          'updated_at' => Carbon::now()
        ];
      }

      \Batch::update(new self, $values, 'id');
    } else {
      foreach ($array as $key => $value) {
        $values[] = [
          $key,
          $id,
          $value,
          Carbon::now(),
          Carbon::now()
        ];
      }

      \Batch::insert(new self, ['slug',  'place_id', 'value', 'created_at',  'updated_at'], $values, 4);
    }
    return $values;
  }


  public  static function getFieldsArr($id)
  {
    return self::getData($id)->pluck('value', 'slug');
  }

  public  static function getVideoFieldsArr($id)
  {
    return self::getVideoData($id)->pluck('value', 'slug');
  }
}
