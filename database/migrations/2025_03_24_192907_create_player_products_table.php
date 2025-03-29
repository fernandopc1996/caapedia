<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('player_products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('coid');
            $table->foreignId('player_action_id')->constrained()->nullable();
            $table->foreignId('player_production_id')->constrained()->nullable();
            $table->char('op')->default('C');
            $table->decimal('amount', total: 12, places: 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_products');
    }
};
