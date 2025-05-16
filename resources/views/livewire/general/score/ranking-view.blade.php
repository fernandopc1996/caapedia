<div>
    <x-layout.header title="Top Classificação" />

    <x-mary-table :headers="$headers" :rows="$topPlayers" :row-decoration="[
        'bg-yellow-100 font-semibold' => fn($row) => $row->player_id === $playerId,
    ]">
        @scope('cell_finished', $row)
            @if ($row->finished)
                ✅ Finalizado
            @else
                🕒 Em progresso
            @endif
        @endscope
    </x-mary-table>

    @if ($currentPlayer && !$topPlayers->pluck('player_id')->contains($currentPlayer->player_id))
        <h2 class="text-lg font-semibold text-gray-900 mt-6 mb-2">Sua Classificação</h2>

        <x-mary-table :headers="$headers" :rows="[$currentPlayer]" :row-decoration="[
            'bg-yellow-100 font-semibold' => fn($row) => true,
        ]" no-headers>
            @scope('cell_finished', $row)
                @if ($row->finished)
                    ✅ Finalizado
                @else
                    🕒 Em progresso
                @endif
            @endscope
        </x-mary-table>
    @endif
</div>
