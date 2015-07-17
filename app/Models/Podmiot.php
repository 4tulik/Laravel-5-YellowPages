<?php
class Podmiot extends Eloquent
{
  public function reviews()
  {
    return $this->hasMany('Review');
  }
  public function recalculateRating()
  {
    $reviews = $this->reviews()->notSpam()->approved();
    $avgRating = $reviews->avg('rating');
    $this->rating_cache = round($avgRating,1);
    $this->rating_count = $reviews->count();
    $this->save();
  }

}
