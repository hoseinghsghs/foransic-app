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
        Schema::table('dossiers', function (Blueprint $table) {
            $table->dropColumn('section');
            $table->foreignId('zone_id')->after('subject')->nullable()->constrained('zones')->cascadeOnDelete();
            $table->foreignId('section_id')->after('subject')->nullable()->constrained('sections')->cascadeOnDelete();
            $table->string('country')->after('subject')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
