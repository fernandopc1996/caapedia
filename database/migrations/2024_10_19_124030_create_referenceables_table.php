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
        //https://laravel.com/docs/11.x/eloquent-relationships#many-to-many-polymorphic-relations
        Schema::create('referenceables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reference_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('referenceable_id');
            $table->string('referenceable_type');
            $table->timestamps();

            $table->index(['referenceable_id', 'referenceable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referenceables');
    }
};
