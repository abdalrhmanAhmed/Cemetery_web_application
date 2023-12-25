<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricalGravesTable extends Migration {

	public function up()
	{
		Schema::create('historical_graves', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->softDeletes();
			$table->string('title', 255);
			$table->string('sub_title', 255);
			$table->text('text');
			$table->string('locations', 255);
		});
	}

	public function down()
	{
		Schema::drop('historical_graves');
	}
}