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
        Schema::create('cracks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('program_version');
            $table->string('license_file')->nullable();
            $table->boolean('is_seen')->default(0);
            $table->text('hardware_code');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('laboratory_id')->nullable()->constrained('laboratories');
            $table->text('description_personal')->nullable();
            $table->text('description_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cracks');
    }
};
