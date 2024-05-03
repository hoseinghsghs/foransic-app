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
        Schema::create('actions', function (Blueprint $table) {
              $table->id();

              $table->text('description');
              $table->string('start_date');
              $table->string('end_date');
              $table->boolean('status');
              $table->boolean('is_print');

              $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
              $table->foreignId('device_id')->nullable()->constrained('devices')->cascadeOnDelete();
              $table->foreignId('action_category_id')->nullable()->constrained('action_category')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
