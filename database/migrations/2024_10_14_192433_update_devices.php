<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            DB::table('devices')->update(['receive_date' => null]);
            $table->timestamp('receive_date')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            //
        });
    }
};
