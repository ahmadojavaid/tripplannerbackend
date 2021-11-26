<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ExperienceResidual extends Model
{

  const FIELD_1 = 'recommended-for',
    FIELD_2 = 'why-this-experience',
    FIELD_3 = 'what-you-can-expect',
    FIELD_4 = "what's-included",
    FIELD_5 = "what's-not-included";



  const VIDEO_LINK = 'video-link';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'slug', 'value', 'experience_id', 'created_at', 'updated_at'
  ];



  public static function getData($id)
  {
    return self::where([
      'experience_id' => $id,
    ])->whereIn('slug', self::getFields())->get();
  }



  public static function getVideoData($id)
  {
    return self::where([
      'experience_id' => $id,
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
          'value' => $array[$value->slug] ?? "",
          'slug' => $value->slug,
          'experience_id' => $id,
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
          $value ?? "",
          Carbon::now(),
          Carbon::now()
        ];
      }
      \Batch::insert(new self, ['slug',  'experience_id', 'value', 'created_at',  'updated_at'], $values, 5);
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
          'experience_id' => $id,
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

      \Batch::insert(new self, ['slug',  'experience_id', 'value', 'created_at',  'updated_at'], $values, 1);
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
