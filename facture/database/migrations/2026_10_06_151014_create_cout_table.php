<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cout', function (Blueprint $table) {

            $table->id();

            $table->foreignId('idmois')
                ->constrained('mois')
                ->onDelete('cascade');

            $table->integer('annee');

            $table->decimal('cout', 10, 2);

            $table->unique([
                'idmois',
                'annee'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cout');
    }
};
