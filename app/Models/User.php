<?php

namespace App\Models;

use App\Models\traits\attributes\UserAttribute;
use Laravel\Passport\HasApiTokens;
use Collective\Html\Eloquent\FormAccessible;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\traits\methods\UserMethod;
use App\Models\traits\miscellaneous\FileMiscellaneous;
use App\Models\traits\relationships\UserRelationship;
use App\Notifications\user\ResetPassword;
use App\Notifications\user\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens,
    Notifiable,
    HasRoles,
    FormAccessible,
    UserMethod,
    UserRelationship,
    UserAttribute,
    FileMiscellaneous;
  public static $guard_name = "web";



  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'first_name', 'last_name', 'phone_no', 'email', 'password', 'avatar'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /** Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   */
  public function sendPasswordResetNotification($token)
  {
    $this->notify(new ResetPassword($token));
  }


  public function sendEmailVerificationNotification()
  {
    $this->notify(new VerifyEmail());
  }
}
