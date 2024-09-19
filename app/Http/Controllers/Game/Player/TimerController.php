<?php

namespace App\Http\Controllers\Game\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TimerController extends Controller
{
    public function changeModeTimer(Request $request, $mode){
        $player = auth()->user()->players()->first();
        $player->mode_time = $mode;
        $player->save();
        $request->session()->put('player', $player);

        return redirect()->back();
    }
}
