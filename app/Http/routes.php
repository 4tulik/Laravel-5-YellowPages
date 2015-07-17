<?php
use App\Models;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::get('woj/{woj}', 'HomeController@showPowiaty');
Route::get('woj/{woj}/pow/{pow}', 'HomeController@showGminy');
Route::get('pow/{pow}/gmi/{gmi}', 'HomeController@showGmina');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('/', function()
{
  $podmioty = Podmiot::all();
  return View::make('index', array('products'=>$products));
});
Route::post('products/{id}', array('before'=>'csrf', function($id)
{
  $input = array(
	'comment' => Input::get('comment'),
	'rating'  => Input::get('rating')
  );
  // instantiate Rating model
  $review = new Review;

  // Validate that the user's input corresponds to the rules specified in the review model
  $validator = Validator::make( $input, $review->getCreateRules());

  // If input passes validation - store the review in DB, otherwise return to product page with error message
  if ($validator->passes()) {
	$review->storeReviewForProduct($id, $input['comment'], $input['rating']);
	return Redirect::to('podmiot/'.$id.'#reviews-anchor')->with('review_posted',true);
  }

  return Redirect::to('podmiot/'.$id.'#reviews-anchor')->withErrors($validator)->withInput();
}));
