<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class PropertyResidual extends Model
{
  use SoftDeletes;
  const FIELD_1 = 'why-this-property-is-special',
    FIELD_2 = 'rooms',
    FIELD_3 = 'experiences',
    FIELD_4 = "cuisine",
    FIELD_5 = "what's-included";


  const VIDEO_LINK = 'video-link';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'slug', 'value', 'property_id', 'created_at', 'updated_at'
  ];
  protected $dates = ['deleted_at'];


  public static function getData($id)
  {
    return self::where([
      'property_id' => $id,
    ])->whereIn('slug', self::getFields())->get();
  }



  public static function getVideoData($id)
  {
    return self::where([
      'property_id' => $id,
    ])->whereIn('slug', self::getVideoFields())->get();
  }

  public static function getFields()
  {
    return [
      self::FIELD_1,
      self::FIELD_2,
      self::FIELD_3,
      self::FIELD_4,
      self::FIELD_5
    ];
  }

  public static function getVideoFields()
  {
    return [
      self::VIDEO_LINK
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
          'property_id' => $id,
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

      \Batch::insert(new self, ['slug',  'property_id', 'value', 'created_at',  'updated_at'], $values, 3);
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
          'property_id' => $id,
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

      \Batch::insert(new self, ['slug',  'property_id', 'value', 'created_at',  'updated_at'], $values, 1);
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
