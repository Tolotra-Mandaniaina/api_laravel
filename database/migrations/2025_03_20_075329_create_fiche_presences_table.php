<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiche_presences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personne_id');  // Clé étrangère vers 'personnes'
            $table->unsignedBigInteger('activite_id');  // Clé étrangère vers 'activites'
            $table->boolean('est_present')->default(false);  // Indique si la personne est présente
            $table->timestamps();
    
            // Définir les clés étrangères
            $table->foreign('personne_id')->references('id')->on('personnes')->onDelete('restrict');
            $table->foreign('activite_id')->references('id')->on('activites')->onDelete('restrict');
        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fiche_presences');
    }
};
