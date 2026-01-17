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
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barberia_id')
                  ->constrained()
                  ->cascadeOnDelete();
                  
            // ? Servicio ID eliminado temporalmente
            // $table->foreignId('servicio_id')
            //       ->constrained()
            //       ->cascadeOnDelete();

            $table->date('fecha');
            $table->time('hora');
            // $table->time('hora_inicio');
            // $table->time('hora_fin');

            $table->string('nombre_cliente');
            $table->string('contacto_cliente');

            $table->enum('estado', ['reservado', 'cancelado'])
                  ->default('reservado');
            
            // Evita doble turno en mismo día y hora
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
