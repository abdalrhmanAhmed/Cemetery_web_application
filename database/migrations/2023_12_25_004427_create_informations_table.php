<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationsTable extends Migration {

	public function up()
	{
		Schema::create('informations', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('deceased_id');
			$table->bigInteger('guardian_id');
			$table->bigInteger('hospital_id');
			$table->bigInteger('grave_id');
			$table->string('medical_diagnosis', 255);
			$table->date('date_of_death');
			$table->date('burial_date');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('informations');
	}
}