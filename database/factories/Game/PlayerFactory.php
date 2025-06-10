<?php

namespace Database\Factories\Game;

use App\Models\Game\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Player>
 */
class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nickname' => $this->faker->unique()->userName(),
            'mode_time' => 0,
            'last_datetime' => '1995-01-01 00:00:00',
            'last_execution' => null,
            'area' => 0.0025,
            'degration' => 0.1,
            'water' => 0,
            'amount' => 0,
            'rate_sell' => 0.8,
            'rate_buy' => 1.1,
            'finished' => 0,
            'finished_story' => null,
            'finished_choice' => null,
            'current_story' => 1,
        ];
    }
}