<?php

namespace App\Models\traits\attributes;


trait CountryAttribute
{
  public function getWhenToGoAttribute()
  {
    return $this->essential->when_to_go;
  }

  public function getWeatherAttribute()
  {
    return $this->essential->weather;
  }

  public function getGettingThereAttribute()
  {
    return $this->essential->getting_there;
  }

  public function getTravelExpensesAttribute()
  {
    return $this->essential->travel_expenses;
  }
  public function getCultureAttribute()
  {
    return $this->essential->culture;
  }
  public function formPriorityAttribute()
  {
    return $this->priority_status;
  }
}
