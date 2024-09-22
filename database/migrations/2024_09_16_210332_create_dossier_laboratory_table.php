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
        Schema::create('dossier_laboratory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laboratory_id')->constrained('laboratories');
            $table->foreignId('dossier_id')->constrained('dossiers');
            $table->timestamps();
        });
        Schema::disableForeignKeyConstraints();
        Schema::table('dossiers', function (Blueprint $table) {
            $table->dropConstrainedForeignId('laboratory_id');
        });
        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_laboratory');
    }
};
