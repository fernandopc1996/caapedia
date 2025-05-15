<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Faker\Factory as Faker;

use App\Models\User;

class GuestUserController extends Controller
{
    public function create(Request $request){
        
        if(Auth::check()) return redirect()->route('story.events');

        $user = new User();
        $faker = Faker::create();
        $user->name = $faker->name;
        $user->email = Str::uuid()."@caapedia";
        $user->password = Hash::make(Str::random(10));
        $user->save();

        Auth::login($user, $remember = true);
        return redirect()->route('story.events');
    }
}
