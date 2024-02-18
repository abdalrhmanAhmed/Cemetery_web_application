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
        Schema::create('excel_temperaries', function (Blueprint $table) {
            $table->id();
            $table->string('first_name_ar');
            $table->string('second_name_ar');
            $table->string('third_name_ar');
            $table->string('fourth_name_ar');
            $table->string('first_name_en');
            $table->string('second_name_en');
            $table->string('third_name_en');
            $table->string('fourth_name_en');
            $table->string('national_number');
            $table->integer('age');
            $table->string('gender');
            $table->string('religion');
            $table->string('nationality');
            $table->string('burial_name_quadruple');
            $table->string('phone_number');
            $table->string('address');
            $table->string('email');
            $table->string('dead_date');
            $table->string('burial_date');
            $table->string('hopital');
            $table->string('reason_of_death');
            $table->string('cemetry');
            $table->string('block');
            $table->string('grave');
            $table->decimal('latitude', 11,2);
            $table->decimal('longitude', 11,2);
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
        Schema::dropIfExists('excel_temperaries');
    }
};
