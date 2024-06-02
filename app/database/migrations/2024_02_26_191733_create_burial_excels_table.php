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
        Schema::create('burial_excels', function (Blueprint $table) {
            $table->id();
            $table->integer('FID');
            $table->string('Cemetery_I');
            $table->string('Grave_Sequ');
            $table->string('Grave_Code');
            $table->string('Grave_Co_1');
            $table->string('Emirates_I');
            $table->string('Name');
            $table->string('Nationalit');
            $table->string('Date_Of_De');
            $table->string('Burial_Dat');
            $table->string('Shahed_Num');
            $table->string('Hospital');
            $table->string('Cause_Of_D');
            $table->string('Cemetery_N');
            $table->string('Death_Repo');
            $table->string('Death_Cert');
            $table->string('Hospital_R');
            $table->string('Police_Mes');
            $table->string('Comments');
            $table->string('Northing');
            $table->string('Easting');
            $table->string('Elevation');
            $table->string('Embassy_No');
            $table->string('Sex');
            $table->string('Country');
            $table->string('Emirates');
            $table->string('NameAr');
            $table->string('NameEn');
            $table->string('Sectors_Ar');
            $table->string('Sectors_En');
            $table->string('X');
            $table->string('Y');
            $table->string('XY');
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
        Schema::dropIfExists('burial_excels');
    }
};
