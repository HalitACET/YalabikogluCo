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
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

        Schema::create('discipline_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discipline_id')->constrained('disciplines')->cascadeOnDelete();
            $table->string('locale', 10);
            
            $table->string('title');
            $table->text('dek')->nullable();
            $table->text('pull_quote')->nullable();
            $table->json('areas_of_focus')->nullable(); // Array of {title, description}
            
            $table->timestamps();
            $table->unique(['discipline_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline_translations');
        Schema::dropIfExists('disciplines');
    }
};
