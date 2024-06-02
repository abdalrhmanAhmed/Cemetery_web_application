<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsDetailsTable extends Migration {

	public function up()
	{
		Schema::create('projects_details', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('project_id');
			$table->string('type');
			$table->string('value');
			$table->boolean('status');
			$table->bigInteger('created_by');
			$table->bigInteger('updated_by');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('projects_details');
	}
}