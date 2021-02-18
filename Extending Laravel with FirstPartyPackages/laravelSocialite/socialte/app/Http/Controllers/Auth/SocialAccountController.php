<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAccountController extends Controller
{
    public function redirectToProvider($provider){
        try {
            //code...
            return Socialite::driver($provider)->redirect();
        } catch (Exception $exception) {
            //throw $th;
            Session::flash('There has been an exception occurred' . $exception);
            redirect('/login');
        }

    }
    public function handleProviderCallBack($provider){
        try {
            //code...
            $user = Socialite::driver($provider)->user();
        } catch (Exception $exception) {
            //throw $excpetion;
            echo $exception;
            Session::flash('There has been an exception occurred' . $exception);
            redirect('/login');
        }
       $authUser = $this->findOrCreateUser($user, $provider);

       Auth::login($authUser, true);

       return redirect($this->redirectToProvider($provider));


    }
    public function findOrCreateUser($socialUser, $provider){
        $account = SocialAccount::where('provider_name', $provider)->where('provider_id',
         $socialUser->getId())->first();

         if($account){
             return $account->user;
         }else{
             $user = User::where('email', $socialUser->getEmail())->first();

             if(! $user){
                 $user = User::create(['email', $socialUser->getEmail(), 'name' => $socialUser->getName()
                 ]);
             }
             $user->accounts()->create([
                 'provider_name' => $provider,
                 'provider_id' => $socialUser->getId()
             ]);
             return $user;
         }

    }
}
