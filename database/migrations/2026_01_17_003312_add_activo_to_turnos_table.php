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
          Schema::table('turnos', function (Blueprint $table) {
                $table->boolean('activo')->default(true);
                
                $table->dropUnique(['barberia_id', 'fecha', 'hora']);

                $table->unique([
                'barberia_id',
                'fecha',
                'hora',
                'activo'
                ], 'turnos_unique_reservado');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('turnos', function (Blueprint $table) {
            //
        });
    }
};
