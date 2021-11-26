<?php

namespace App\Models\traits\methods;


trait UserMethod
{
  public function isAdmin()
  {
    return $this->hasRole('admin');
  }

  public function isBlogUser()
  {
    return $this->hasRole('blog user');
  }

  public function isUser()
  {
    return $this->hasRole('user');
  }

  public function getDirectory()
  {
    return  'users';
  }

  public function getAvatar()
  {
    $file = false;
    if ($this->avatar)
    {
     $file = \FileHelper::generateImagePath($this->id, $this->avatar, $this->getDirectory(),true);
//    $file = asset('storage/'.$this->getDirectory().'/'.$this->id.'/'.$this->avatar);
    }
    else if ($socialAccount = $this->socialAccount) {

      $file = $socialAccount->avatar;
    }

    if ($file)
      return $file;
    else
      return 'https://via.placeholder.com/300';
  }
}
