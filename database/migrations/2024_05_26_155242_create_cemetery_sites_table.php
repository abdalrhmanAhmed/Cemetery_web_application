<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemeterySitesTable extends Migration {

	public function up()
	{
		Schema::create('cemetery_sites', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->text('image', 255);
			$table->text('text', 255);
			$table->integer('dead_total')->default('0');
			$table->string('latitude')->default('0');
			$table->string('longitude')->default('0');
			// $table->polygon('coordinates');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cemetery_sites');
	}
}