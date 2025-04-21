<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_email', $googleUser->email)->first();
        if(!$user) {
            $user = User::create([
                'name' => $googleUser->name, 
                'email' => $googleUser->email, 
                'google_email' => $googleUser->email, 
                'password' => \Hash::make(rand(100000,999999))
            ]);
        }else{
            $user->google_email = $googleUser->email;
        }

        Auth::login($user, $remember = true);
        
        return redirect()->route('story.events');
    }
}
