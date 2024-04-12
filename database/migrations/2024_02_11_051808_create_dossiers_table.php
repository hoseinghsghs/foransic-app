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
        Schema::create('dossiers', function (Blueprint $table) {
            $table->id();
            $table->string('number_dossier');
            $table->string('name');
            $table->string('subject');
            $table->string('section');
            $table->text('summary_description');
            $table->text('expert');
            $table->boolean('is_active')->default(1);
            $table->boolean('is_archive')->default(1);
            $table->bigInteger('user_category_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossiers');
    }
};
