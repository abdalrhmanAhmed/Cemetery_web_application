<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRowsTable extends Migration {

	public function up()
	{
		Schema::create('rows', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->bigInteger('block_id');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('rows');
	}
}