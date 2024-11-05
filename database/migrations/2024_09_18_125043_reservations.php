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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('name_user');
            $table->string('name_email');
            $table->string('class');             // Turma 
            $table->date('date');                // Data da reserva
            $table->time('time');                // Horário da reserva
            $table->text('integrantes');         // Integrantes 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('reservations');
    }
};
