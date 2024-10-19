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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', length: 60);
            $table->string('description', length: 150)->nullable();
            $table->foreignId('category_id')->constrained();

            $table->float('difficulty', 5, 4)->default(0.1);
            $table->integer('creation_time')->default(24);
            $table->string('path_image_square', length: 100)->nullable();
            $table->string('path_image_full', length: 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
