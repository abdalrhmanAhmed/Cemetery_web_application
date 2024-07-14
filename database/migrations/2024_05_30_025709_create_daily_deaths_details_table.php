<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDailyDeathsDetailsTable extends Migration {

	public function up()
	{
		Schema::create('daily_deaths_details', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('project_id');
			$table->string('type');
			$table->text('value');
			$table->bigInteger('created_by');
			$table->bigInteger('updated_by');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('daily_deaths_details');
	}
}