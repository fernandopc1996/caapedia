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
        Schema::create('player_actions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_production_id')->nullable()->constrained();
            $table->foreignId('player_character_id')->constrained();
            $table->smallInteger('cycles')->nullable();
            $table->string('coid_type')->nullable();
            $table->unsignedInteger('coid')->nullable();
            $table->boolean('completed')->default(0);
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->unsignedSmallInteger('multiplier_times')->default(1);
            $table->unsignedSmallInteger('multiplier_quantity')->default(1);
            $table->decimal('increase_production', total: 9, places: 6)->nullable();
            $table->decimal('area', total: 12, places: 4);
            $table->decimal('degration', total: 15, places: 6);
            $table->decimal('water', total: 16, places: 3);
            $table->decimal('amount', total: 16, places: 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_actions');
    }
};
