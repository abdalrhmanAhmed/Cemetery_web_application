<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailyDeathsTable extends Migration {

	public function up()
	{
		Schema::create('daily_deaths', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('image');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('daily_deaths');
	}
}