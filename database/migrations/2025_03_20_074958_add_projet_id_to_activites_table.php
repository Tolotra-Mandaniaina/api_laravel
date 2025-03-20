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
        Schema::table('activites', function (Blueprint $table) {
                // Ajoute la colonne projet_id
                $table->unsignedBigInteger('projet_id');  
                
                // Ajoute la contrainte de clé étrangère
                $table->foreign('projet_id')->references('id')->on('projets')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activites', function (Blueprint $table) {
            //
            $table->dropForeign(['projet_id']);
            $table->dropColumn('projet_id');
        });
    }
};
