<div class="p-4 space-y-6">
    <x-layout.header title="Finanças" />

    <div class="flex items-center justify-between mb-4">
        <x-mary-button 
            icon="fas.arrow-left" 
            class="btn-primary btn-outline"
            label="{{ $year - 1 }}" 
            wire:click="previousYear"
            :disabled="!$this->canGoToPreviousYear()"
        />
    
        <span class="text-lg font-bold text-gray-700">Ano: {{ $year }}</span>
    
        <x-mary-button 
            icon="fas.arrow-right" 
            class="btn-primary btn-outline"
            label="{{ $year + 1 }}" 
            wire:click="nextYear"
            :disabled="!$this->canGoToNextYear()"
        />
    </div>

    @foreach($statements as $month => $types)
        @php
            $credit = collect($types['crédito'] ?? [])->sum('amount');
            $debit = collect($types['débito'] ?? [])->sum('amount');
            $balance = $credit - $debit;
        @endphp

        <div class="shadow rounded-xl p-4">
            <h2 class="text-lg font-bold text-gray-800 mb-2 uppercase">{{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</h2>

            <div class="text-sm mb-2">
                <span class="text-green-900 font-semibold">Total Crédito: R$ {{ number_format($credit, 2, ',', '.') }}</span>
                <span class="text-red-900 font-semibold ml-4">Total Débito: R$ {{ number_format($debit, 2, ',', '.') }}</span>
                <span class="ml-4 font-semibold {{ $balance >= 0 ? 'text-green-700' : 'text-red-700' }}">
                    Resultado: R$ {{ number_format($balance, 2, ',', '.') }}
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach(['crédito', 'débito'] as $type)
                    @if(isset($types[$type]))
                        <div>
                            <h3 class="text-md font-semibold text-{{ $type === 'crédito' ? 'green' : 'red' }}-800 uppercase">
                                {{ $type }}
                            </h3>
                            <ul class="mt-2 space-y-1">
                                @foreach($types[$type] as $entry)
                                    <li class="flex justify-between text-sm text-gray-700">
                                        <span>{{ $entry['label'] }}</span>
                                        <span class="font-medium">
                                            R$ {{ number_format($entry['amount'], 2, ',', '.') }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach

    @if(empty($statements))
        <div class="text-gray-500 italic">Nenhum dado financeiro encontrado para o ano selecionado.</div>
    @endif
</div>
