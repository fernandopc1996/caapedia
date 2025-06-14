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
        Schema::create('player_productions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('type_area')->default(1);
            $table->tinyInteger('status_area')->nullable();
            $table->unsignedInteger('sequence')->default(1);
            $table->unsignedInteger('native_cleaning_coid')->nullable();
            $table->unsignedInteger('crop_coid')->nullable();
            $table->string('name', 100)->nullable();
            $table->unsignedInteger('coid')->nullable();
            $table->dateTime('start_build')->nullable();
            $table->dateTime('end_build')->nullable();
            $table->foreignId('player_character_id')->constrained();
            $table->boolean('completed')->default(0);
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
        Schema::dropIfExists('player_productions');
    }
};
