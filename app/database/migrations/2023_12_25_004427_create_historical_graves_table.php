<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricalGravesTable extends Migration {

	public function up()
	{
		Schema::create('historical_graves', function(Blueprint $table) {
			$table->id();
			$table->string('title', 255);
			$table->string('name', 255);
			$table->text('text');
			$table->string('latitude', 255);
			$table->string('Longitude', 255);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('historical_graves');
	}
}