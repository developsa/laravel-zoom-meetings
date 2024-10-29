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
        Schema::table('zoom_meetings', function (Blueprint $table) {
            $table->longText('start_link')->nullable()->change();
            $table->longText('join_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zoom_meetings', function (Blueprint $table) {
            $table->string('start_link')->nullable()->change();
            $table->string('join_link')->nullable()->change();
        });
    }
};
