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
        Schema::create('consommation', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idutilisateur')
                ->constrained('utilisateur')
                ->onDelete('cascade');

            $table->foreignId('idmois')
                ->constrained('mois')
                ->onDelete('cascade');

            $table->decimal('consommation', 10, 2);

            $table->timestamp('created_at')->useCurrent();

            $table->unique(['idutilisateur', 'idmois']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consommation');
    }
};
