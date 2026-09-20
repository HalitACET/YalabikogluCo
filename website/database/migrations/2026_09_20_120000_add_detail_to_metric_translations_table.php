<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Proof points carry three parts, not two: a label naming what is being
     * shown ("International Experience"), the claim itself ("Europe"), and a
     * supporting line that makes the claim concrete. Only the first two had
     * somewhere to live.
     */
    public function up(): void
    {
        Schema::table('metric_translations', function (Blueprint $table) {
            $table->text('detail')->nullable()->after('label');
        });
    }

    public function down(): void
    {
        Schema::table('metric_translations', function (Blueprint $table) {
            $table->dropColumn('detail');
        });
    }
};
