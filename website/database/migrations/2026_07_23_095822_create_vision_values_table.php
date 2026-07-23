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
        Schema::create('vision_values', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('vision_value_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vision_value_id')->constrained('vision_values')->cascadeOnDelete();
            $table->string('locale', 10);
            
            $table->string('title');
            $table->text('description');
            
            $table->timestamps();
            $table->unique(['vision_value_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vision_value_translations');
        Schema::dropIfExists('vision_values');
    }
};
