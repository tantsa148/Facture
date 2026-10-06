<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consommation', function (Blueprint $table) {
            $table->integer('annee')->default(2026)->after('idmois');
        });

        Schema::table('consommation', function (Blueprint $table) {
            $table->dropUnique(['idutilisateur', 'idmois']);

            $table->unique(['idutilisateur', 'idmois', 'annee']);
        });
    }

    public function down(): void
    {
        Schema::table('consommation', function (Blueprint $table) {
            $table->dropUnique(['idutilisateur', 'idmois', 'annee']);
            $table->unique(['idutilisateur', 'idmois']);

            $table->dropColumn('annee');
        });
    }
};