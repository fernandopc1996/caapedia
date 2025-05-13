<div>
    <x-layout.header title="Empréstimo" />

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach ($loans as $loan)
            @php
                $hasLoan = $this->player->playerFinances()
                    ->where('type', \App\Enums\TypeFinance::LOAN)
                    ->where('op', 'C')
                    ->where('coid_type', \App\Repositories\LoanRepository::class)
                    ->where('coid', $loan->id)
                    ->where('completed', false)
                    ->exists();

                $inflaction = $player->getInflationValue(1, 'C');
                $trustOk = $loan->loan['min_trust'] <= $inflaction;
                $disabled = $hasLoan || !$trustOk;
                $max_amount = $loan->loan['max_amount'] * $inflaction;

                $rates = $loan->loan['rates'];
                $minRate = number_format(min($rates) * 100, 2, ',', '.');
                $maxRate = number_format(max($rates) * 100, 2, ',', '.');
            @endphp

            <form wire:submit.prevent="loanSubmit({{ $loan->id }})"
                class="border border-black rounded-lg p-4 shadow-sm bg-transparent space-y-2 h-full flex flex-col justify-between relative">

                {{-- Tag com o tipo --}}
                <span class="absolute top-2 right-2 bg-gray-800 text-white text-xs px-2 py-0.5 rounded">
                    {{ ucfirst($loan->type) }}
                </span>

                <div>
                    <h3 class="text-xl font-semibold mb-1 mt-4">{{ $loan->name }}</h3>
                    <p class="text-sm text-gray-900 mb-2 text-justify">{{ $loan->description }}</p>

                    {{-- Usos permitidos --}}
                    @if (!empty($loan->loan['allowed_uses']))
                        <ul class="text-xs text-gray-800 list-disc list-inside mb-3 ml-5">
                            @foreach ($loan->loan['allowed_uses'] as $use)
                                <li>{{ $use }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {{-- Link externo opcional --}}
                    @if ($loan->source)
                        <a href="{{ $loan->source }}" target="_blank"
                            class="block text-center w-full bg-black text-white py-1.5 rounded mb-2 text-sm font-semibold">
                            Clique aqui para detalhes
                        </a>
                    @endif

                    {{-- Detalhes técnicos --}}
                    <div class="grid grid-cols-2 gap-2 text-sm mb-3">
                        <x-game.production.build-item icon="fas.coins" label="Máx"
                            value="R$ {{ number_format($max_amount, 2, ',', '.') }}" color="yellow-600" />

                        <x-game.production.build-item icon="fas.percent" label="Juros"
                            value="{{ $minRate }} a {{ $maxRate }}%" color="red-600" />

                        <x-game.production.build-item icon="fas.clock" label="Parcelas"
                            value="{{ implode(', ', $loan->loan['installments']) }}" color="gray-600" />
                    </div>
                </div>

                <div class="space-y-2">
                    @if (!$hasLoan && $trustOk)
                        <select wire:model.defer="installments.{{ $loan->id }}"
                            class="w-full border border-black rounded px-3 py-1 text-sm" @disabled($disabled)>
                            <option value="">Escolha as parcelas</option>
                            @foreach ($loan->loan['installments'] as $parcela)
                                <option value="{{ $parcela }}">
                                    {{ $parcela }}x
                                    ({{ number_format($loan->loan['rates'][$parcela] * 100, 2, ',', '.') }}% a.m.)
                                </option>
                            @endforeach
                        </select>
                    @endif

                    <button type="submit"
                        class="w-full bg-black text-white py-1.5 rounded text-sm font-semibold hover:bg-gray-800 transition disabled:opacity-50"
                        @disabled($disabled)>
                        @if ($hasLoan)
                            Já contratado
                        @elseif (!$trustOk)
                            Indisponível
                        @else
                            Contratar
                        @endif
                    </button>
                </div>
            </form>
        @endforeach
    </div>
</div>
