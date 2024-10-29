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
        if (!Schema::hasTable('zoom_meetings')) {
            Schema::create('zoom_meetings', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
                $table->string('meeting_id')->nullable();
                $table->string('meeting_name',100);
                $table->longText('description')->nullable();
                $table->string('password',100)->nullable();
                $table->dateTime('start_date_time');
                $table->dateTime('end_date_time');
                $table->string('start_link')->nullable();
                $table->string('join_link')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoom_meetings');
    }
};
