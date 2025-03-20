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
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();
            $table->string("denomination");
            $table->string("sigle");
            $table->string("statut");
            $table->string("anneeConstitution");
            $table->string("numeroEnregistrement");
            $table->string("region");
            $table->string("codeRegion");
            $table->string("district");
            $table->string("codeDistrict");
            $table->string("commune");
            $table->string("codeCommune");
            $table->string("adresse");
            $table->string("siteWeb");
            $table->string("fb");
            $table->string("email");
            $table->string("tel");

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
        Schema::dropIfExists('organisations');
    }
};
