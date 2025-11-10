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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            // Datos personales
            $table->string('nombre');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('fotografia')->nullable();
            $table->string('curp');
            
            // Dirección
            $table->string('calle');
            $table->string('manzana')->nullable();
            $table->string('lote')->nullable();
            $table->string('numero')->nullable();
            $table->string('codigo_postal');
            $table->string('municipio');
            
            // Datos electorales y profesionales
            $table->string('seccion_electoral');
            $table->string('ocupacion_actual');
            $table->enum('experiencia', ['Si', 'No']);
            $table->text('detalle_experiencia')->nullable();
            $table->text('secciones_desarrollarse');
            $table->text('por_que_propone');
            $table->text('corriente_politica');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
