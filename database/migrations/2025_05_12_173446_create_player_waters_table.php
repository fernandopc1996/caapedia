<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Support\Str;
use App\Services\Game\Finance\FinancialStatementService;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('player_waters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_character_id')->nullable()->constrained();
            $table->dateTime('date')->nullable();
            $table->decimal('degration', total: 15, places: 6)->nullable();
            $table->decimal('water', total: 16, places: 3)->nullable();
            $table->decimal('amount', total: 16, places: 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_waters');
    }
};
