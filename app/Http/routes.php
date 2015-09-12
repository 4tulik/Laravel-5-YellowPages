<?php
use App\Models;
use Illuminate\Database\Eloquent\Model;
use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use App\User;
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
Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

Route::get('/', 'ItemController@index');
Route::get('woj/{woj}', 'ItemController@showPowiaty');
Route::get('woj/{woj}/pow/{pow}', 'ItemController@showGminy');
Route::get('woj/{woj}/pow/{pow}/gmi/{gmi}', 'ItemController@showGmina');

Route::any('/search', 'SearchController@search');

Route::get('facebook/authorize', function () {
	return OAuth::authorize('facebook');
});
Route::get('google/authorize', function () {
  return OAuth::authorize('google');
});
Route::get('facebook/login', 'SocialController@facebookLogin');


Route::get('google/redirect', 'SocialController@googleRedirect');

Route::any('autocomplete/', 'SearchController@autocomplete');

Route::get('podmiot/{slug}', 'ItemController@showItem');


// Route that handles submission of review - rating/comment
Route::post('podmiot/{slug}', array('before'=>'csrf', 'ReviewController@addReview'));
