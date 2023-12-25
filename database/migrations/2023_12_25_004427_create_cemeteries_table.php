<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemeteriesTable extends Migration {

	public function up()
	{
		Schema::create('cemeteries', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->bigInteger('citiy_id');
			$table->string('latitude', 255);
			$table->string('Longitude', 255);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cemeteries');
	}
}