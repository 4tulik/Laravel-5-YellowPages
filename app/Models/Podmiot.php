<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Podmiot extends Model
{
    protected $table = 'podmiot';
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
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
