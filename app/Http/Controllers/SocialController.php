<?php
namespace App\Http\Controllers;

use SocialNorm\Exceptions\ApplicationRejectedException;
use SocialNorm\Exceptions\InvalidAuthorizationCodeException;
use OAuth;

class SocialController extends Controller {

    public function facebookLogin(){
        OAuth::login('facebook', function($user, $details) {
            $user->name = $details->nickname;
            $user->username = $details->nickname;
            $user->email = $details->email;
            $user->avatar = $details->avatar;
            $user->save();
        });
        return redirect()->action('HomeController@index');
    }
    public function googleRedirect(){
        OAuth::login('google', function($user, $details) {
            $user->name = $details->nickname;
            $user->username = $details->nickname;
            $user->email = $details->email;
            $user->avatar = $details->avatar;
            $user->save();
        });

        return redirect()->action('HomeController@index');
    }
}
