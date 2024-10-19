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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 60);
            $table->string('description', length: 150)->nullable();
            $table->foreignId('category_id')->constrained();

            $table->unsignedTinyInteger('start_age')->default(15);
            $table->string('path_front_square', length: 100)->nullable();
            $table->string('path_side_square', length: 100)->nullable();
            $table->string('path_front_partial', length: 100)->nullable();
            $table->string('path_side_partial', length: 100)->nullable();
            $table->string('path_front_full', length: 100)->nullable();
            $table->string('path_side_full', length: 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
