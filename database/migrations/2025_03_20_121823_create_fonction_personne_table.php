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
        Schema::create('fonction_personne', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fonction_id')->constrained()->onDelete('restrict'); // Relation avec la table fonctions
            $table->foreignId('personne_id')->constrained()->onDelete('restrict'); // Relation avec la table personnes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fonction_personne');
    }
};
