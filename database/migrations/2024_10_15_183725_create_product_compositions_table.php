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
        Schema::create('product_compositions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->float('quantity', 12, 4)->default(1);

            $table->foreignId('composition_product_id')->constrained(
                table: 'products'
            )->nullable();
            $table->foreignId('composition_fauna_id')->constrained(
                table: 'fauna'
            )->nullable();
            $table->foreignId('composition_flora_id')->constrained(
                table: 'flora'
            )->nullable();
            $table->float('composition_quantity', 12, 4)->default(1);
            $table->integer('composition_water')->nullable();
            $table->float('composition_money', 12, 4)->nullable();
            $table->foreignId('required_area_id')->constrained(
                table: 'areas'
            )->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_compositions');
    }
};
