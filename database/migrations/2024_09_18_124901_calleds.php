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
        Schema::create('calleds', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_open');
            $table->dateTime('date_end');
            $table->enum('status', ['1','2','3']);
            $table->enum('priority', ['1','2','3']);
            $table->enum('type_problem', ['1','2','3','4','5','6','7']);
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::drop('calleds');
    }
};
