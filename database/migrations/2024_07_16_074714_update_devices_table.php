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
        Schema::table(
            'devices',
            function (Blueprint $table) {
                $table->text('reply_correspondence_number')->after('correspondence_number')->nullable();
                $table->text('reply_correspondence_date')->after('correspondence_date')->nullable();
                $table->unsignedInteger('parent_id')->after('id')->default(0);
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
