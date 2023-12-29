<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGravesTable extends Migration {

	public function up()
	{
		Schema::create('graves', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255)->unique();
			$table->bigInteger('block_id');
			$table->integer('status')->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('graves');
	}
}