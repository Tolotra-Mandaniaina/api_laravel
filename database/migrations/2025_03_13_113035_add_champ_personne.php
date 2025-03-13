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
        Schema::table('personnes', function (Blueprint $table) {
            $table->boolean('psh');
            $table->string('email');
            $table->string('fb');
            $table->string('fonction');
            $table->string('organisation');
            $table->string('region');
            $table->string('codeRegion');
            $table->string('district');
            $table->string('codeDistrict');
            $table->string('commune');
            $table->string('CodeCommune');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personnes', function (Blueprint $table) {
              // Revert changes if needed
             
        });
    }
};
