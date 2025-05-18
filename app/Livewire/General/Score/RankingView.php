<?php

namespace App\Livewire\General\Score;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Game\PlayerScore;
use Illuminate\Support\Facades\Session;

class RankingView extends Component
{
    #[Title('Top Classificação')] 
    public $topPlayers = [];
    public $currentPlayer = null;
    public $playerId;
    public $headers = [
            ['key' => 'position', 'label' => '#'],
            ['key' => 'nickname', 'label' => 'Apelido'],
            ['key' => 'last_datetime', 'label' => 'Último dia', 'format' => ['date', 'd/m/Y'], 'class' => 'hidden lg:table-cell'], 
            ['key' => 'finished', 'label' => 'Finalizado', 'class' => 'hidden lg:table-cell'],
            ['key' => 'score', 'label' => 'Pontuação', 'format' => ['currency', '0,,', ''], 'class' => 'text-right font-bold'],
            
        ];

    public function mount()
    {
        $this->playerId = Session::get('player_id');

        $this->topPlayers = PlayerScore::orderBy('position')
            ->take(10)
            ->get()
            ->map(function ($player) {
                $player->score = max(0, $player->score);
                return $player;
            });

        $this->currentPlayer = PlayerScore::where('player_id', $this->playerId)->first();

        if ($this->currentPlayer) {
            $this->currentPlayer->score = max(0, $this->currentPlayer->score);
        }
    }

    public function render()
    {
        return view('livewire.general.score.ranking-view');
    }
}