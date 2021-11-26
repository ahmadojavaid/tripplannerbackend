<?php

namespace App\Models\traits\relationships;

use App\Models\SocialAccount;

trait UserRelationship
{
  public function socialAccount()
  {
    return $this->hasOne(SocialAccount::class,  'user_id', 'id');
  }
}
