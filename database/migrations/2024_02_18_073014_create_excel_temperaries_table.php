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
            $table->string('cemetery_id');
            $table->string('grave_sequence');
            $table->string('grave_code');
            $table->string('grave_code2');
            $table->string('emirates_id');
            $table->string('hospital_certificate_number');
            $table->string('legacy_coding');
            $table->string('name');
            $table->string('cause_of_death');
            $table->string('kinship');
            $table->string('case_number');
            $table->string('case_type');
            $table->string('nationality');
            $table->string('date_of_death');
            $table->string('burial_date');
            $table->string('shahed_number');
            $table->string('hospital');
            $table->string('cemetery_name');
            $table->string('death_report');
            $table->string('death_certificate');
            $table->string('hospital_report');
            $table->string('police_message');
            $table->string('comments');
            $table->string('northing');
            $table->string('easting');
            $table->string('elevation');
            $table->string('embassy_notes');
            $table->string('gender');
            $table->string('country');
            $table->string('emirates');
            $table->string('namear');
            $table->string('nameen');
            $table->string('sectors_ar');
            $table->string('sectors_en');
            $table->string('x');
            $table->string('y');
            $table->string('xy');
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
