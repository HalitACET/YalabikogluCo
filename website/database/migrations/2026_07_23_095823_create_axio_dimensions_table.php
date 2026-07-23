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
        Schema::create('axio_dimensions', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('axio_dimension_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('axio_dimension_id')->constrained('axio_dimensions')->cascadeOnDelete();
            $table->string('locale', 10);
            
            $table->string('title');
            $table->text('description');
            
            $table->timestamps();
            $table->unique(['axio_dimension_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('axio_dimension_translations');
        Schema::dropIfExists('axio_dimensions');
    }
};
