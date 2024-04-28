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
            // فیلد چهارم
            $table->string('dossier_type');
            $table->string('dossier_case');
            $table->string('expert_phone');
            $table->string('expert_cellphone');
            //سه فیلد حکم قضایی
            $table->string('Judicial_number')->nullable();
            $table->string('Judicial_image')->nullable();
            $table->string('Judicial_date')->nullable();

            $table->text('summary_description')->nullable();
            $table->text('expert')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_archive')->default(1);
            $table->foreignId('user_category_id')->constrained('users');
            $table->foreignId('personal_creator_id')->constrained('users');

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
