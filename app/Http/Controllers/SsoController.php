<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use App\User;
use Auth;

class SsoController extends Controller
{
    /**
     * [singleSignOn login and redirect to url]
     * @param  [string] $encoded_email [encoded email]
     * @param  [string] $encoded_key   [encoded key]
     * @param  [string] $encoded_url   [encoded url]
     * @return [route]                 [redirect to url]
     */
    public function singleSignOn($encoded_email, $encoded_key, $encoded_url)
    {

      $decoded_email = base64_decode($encoded_email);
      $decoded_key = base64_decode($encoded_key);
      $decoded_url = base64_decode($encoded_url);

      $user = User::where('email', $decoded_email)->first();
      if(!$user){
        return back()->with('error', 'User email does not exist');
      }
      $api_key = $user->companies()->where('api_key', $decoded_key)->first();
      if($api_key == null){
        return back()->with('error', 'API key not valid');
      }

      Auth::login($user);

      return redirect($decoded_url);
    }
}
