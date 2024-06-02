<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailyDeathsTable extends Migration {

	public function up()
	{
		Schema::create('daily_deaths', function(Blueprint $table) {
			$table->increments('id');
			$table->string('dead_name');
			$table->string('nationalaty');
			$table->smallInteger('age');
			$table->string('pra_day');
			$table->string('pray_date');
			$table->string('pray_note');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('daily_deaths');
	}
}