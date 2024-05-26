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
        Schema::create('laboratories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('0');
            $table->string('province')->default('0');
            $table->string('place')->default('0');
            $table->string('internal_number')->default('0');
            $table->string('permanent_personnel_count')->default('0');
            $table->string('temporary_personnel_count')->default('0');
            $table->string('laptop_count')->default('0');
            $table->string('tablet_count')->default('0');
            $table->string('version_ufed_for_pc')->default('0');
            $table->string('version_ufed_analyzer')->default('0');
            $table->string('version_oxygen')->default('0');
            $table->string('version_axiom')->default('0');
            $table->string('version_final_mobile')->default('0');
            $table->text('description')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratories');
    }
};
