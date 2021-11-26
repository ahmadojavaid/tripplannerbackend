<?php

namespace App\Models\traits\attributes;

trait UserAttribute
{

  public function getRoleNameAttribute()
  {
    return ucwords($this->roles->first()->name);
  }

  public function getRoleIdAttribute()
  {
    return ucwords($this->roles->first()->id);
  }

  public function formRoleAttribute()
  {
    return $this->roles->first()->id;
  }

  public function formPermissionsAttribute()
  {
    return $this->permissions->first() ? $this->permissions->pluck('id')->toArray() : [];
  }

  public function getNameAttribute()
  {
    return $this->first_name . ' ' . $this->last_name;
  }
}
