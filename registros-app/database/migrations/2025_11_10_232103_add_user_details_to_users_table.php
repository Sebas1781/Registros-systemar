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
        Schema::table('users', function (Blueprint $table) {
            $table->string('apellido_paterno')->nullable()->after('name');
            $table->string('apellido_materno')->nullable()->after('apellido_paterno');
            $table->string('curp', 18)->nullable()->after('apellido_materno');
            $table->string('calle')->nullable()->after('curp');
            $table->string('manzana', 10)->nullable()->after('calle');
            $table->string('lote', 10)->nullable()->after('manzana');
            $table->string('numero', 10)->nullable()->after('lote');
            $table->string('codigo_postal', 5)->nullable()->after('numero');
            $table->string('municipio')->nullable()->after('codigo_postal');
            $table->string('seccion_electoral')->nullable()->after('municipio');
            $table->string('telefono', 15)->nullable()->after('seccion_electoral');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'apellido_paterno',
                'apellido_materno',
                'curp',
                'calle',
                'manzana',
                'lote',
                'numero',
                'codigo_postal',
                'municipio',
                'seccion_electoral',
                'telefono'
            ]);
        });
    }
};
