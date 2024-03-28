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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('delivery_name')->nullable();
            $table->string('delivery_code')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_code')->nullable();

            $table->string('delivery_staff_id')->nullable();
            $table->string('receiver_staff_id')->nullable();

            $table->string('delivery_date')->nullable();
            $table->string('receiver_date')->nullable();

            $table->text('accessories')->nullable();
            $table->text('description')->nullable();


            $table->string('primary_image')->nullable();

            $table->string('status')->default(0);

            $table->boolean('is_active')->default(1);

            $table->boolean('is_archive')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
