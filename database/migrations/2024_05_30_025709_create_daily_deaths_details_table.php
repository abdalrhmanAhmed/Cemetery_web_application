<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailyDeathsDetailsTable extends Migration {

	public function up()
	{
		Schema::create('daily_deaths_details', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('daily_death_id');
			$table->string('key');
			$table->string('value');
			$table->bigInteger('created_by');
			$table->bigInteger('updated_by');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('daily_deaths_details');
	}
}