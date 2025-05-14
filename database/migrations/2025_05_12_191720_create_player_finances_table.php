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
        Schema::create('player_finances', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('player_id')->constrained()->onDelete('cascade');
            $table->foreignId('player_character_id')->nullable()->constrained();
            $table->foreignId('player_finance_id')->nullable()->constrained();
            $table->smallInteger('type')->default(1);
            $table->char('op')->default('D');
            $table->string('coid_type')->nullable();
            $table->unsignedInteger('coid')->nullable();
            $table->dateTime('date')->nullable();
            $table->smallInteger('installment')->nullable();
            $table->smallInteger('installments')->nullable();
            $table->decimal('amount', total: 16, places: 2)->nullable();
            $table->string('description', 100)->nullable();
            $table->boolean('completed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_finances');
    }
};
