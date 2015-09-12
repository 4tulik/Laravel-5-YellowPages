<?php
namespace App\Http\Controllers;

use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use OAuth;


class ReviewController extends Controller {

  function addReview(App\Models\Review $review, $slug)
  {
    $id = substr($slug, -7);

    if (Request::getMethod() == 'POST')
          {
              $rules = ['captcha' => 'required|captcha'];
              $validator = Validator::make(Input::all(), $rules);
              if ($validator->fails())
              {
                return Redirect::to('podmiot/'.$slug.'#reviews-anchor')->withErrors("Błędny kod captcha")->withInput();
              }
              else
              {
   $input = array(
    'comment' => Input::get('comment'),
    'rating'  => Input::get('rating')
    );

    // Validate that the user's input corresponds to the rules specified in the review model
    $validator = Validator::make( $input, $review->getCreateRules());

    // If input passes validation - store the review in DB, otherwise return to product page with error message
    if ($validator->passes()) {
    $review->storeReviewForProduct($id, $input['comment'], $input['rating']);
    return Redirect::to('podmiot/'.$slug.'#reviews-anchor')->with('review_posted',true);
    }

    return Redirect::to('podmiot/'.$slug.'#reviews-anchor')->withErrors($validator)->withInput();
              }
          }
   }
}
