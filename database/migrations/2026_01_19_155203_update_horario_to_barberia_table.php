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
            Schema::table('barberias', function (Blueprint $table) {
                $table->time('hora_apertura')->default('09:00');
                $table->time('hora_cierre')->default('18:00');
                $table->integer('duracion_turno')->default(30);
            });
        }

    public function down(): void
    {
        Schema::table('barberias', function (Blueprint $table) {
            $table->dropColumn([
                'hora_apertura',
                'hora_cierre',
                'duracion_turno',
            ]);
        });
    }

};
