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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');;
            $table->string('nickname', 30)->unique();
            $table->unsignedTinyInteger('mode_time')->default(0);
            $table->dateTime('last_datetime')->default('1995-01-01 00:00:00');
            $table->dateTime('last_execution')->nullable();
            $table->decimal('area', total: 12, places: 4)->default(0.0025);
            $table->decimal('degration', total: 15, places: 6)->default(0.1);
            $table->decimal('water', total: 16, places: 3)->default(1);
            $table->decimal('amount', total: 16, places: 2)->default(1000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
