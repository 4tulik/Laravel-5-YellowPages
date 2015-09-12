<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
      // Validation rules for the ratings
    public function getCreateRules()
    {
        return array(
            'comment'=>'required|min:10',
            'rating'=>'required|integer|between:1,5'
        );
    }

   public function user()
   {
    return $this->belongsTo('App\User');
}

public function product()
{
    return $this->belongsTo('App/Models/Podmiot');
}
    // Scopes
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
    public function scopeSpam($query)
    {
        return $query->where('spam', true);
    }
    public function scopeNotSpam($query)
    {
        return $query->where('spam', false);
    }
    // Attribute presenters
    public function getTimeagoAttribute()
    {
      $date = \Carbon\Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
      return $date;
    }
    // this function takes in product ID, comment and the rating and attaches the review to the product by its ID, then the average rating for the product is recalculated
    public function storeReviewForProduct($productID, $comment, $rating)
    {
        $product = Podmiot::find($productID);
        //$this->user_id = Auth::user()->id;
        $this->comment = $comment;
        $this->rating = $rating;
        $product->reviews()->save($this);
        // recalculate ratings for the specified product
        $product->recalculateRating($rating);
    }
}
