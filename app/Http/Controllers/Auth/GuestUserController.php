<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\User;

class GuestUserController extends Controller
{
    public function create(Request $request){
        
        if(Auth::check()) return redirect()->route('story.events');

        $user = new User();
        $user->name = Str::uuid();
        $user->email = $user->name."@caapedia";
        $user->password = Hash::make(Str::random(10));
        $user->save();

        Auth::login($user, $remember = true);
        return redirect()->route('story.events');
    }
}
