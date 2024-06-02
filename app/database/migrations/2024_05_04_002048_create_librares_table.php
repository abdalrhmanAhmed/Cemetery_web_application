<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraresTable extends Migration {

	public function up()
	{
		Schema::create('librares', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->string('image', 255);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('librares');
	}
}