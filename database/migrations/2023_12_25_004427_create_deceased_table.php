<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeceasedTable extends Migration {

	public function up()
	{
		Schema::create('deceased', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->string('father', 255);
			$table->string('grand_father', 255);
			$table->string('great_grand_father', 255);
			$table->string('identity', 255);
			$table->smallInteger('age')->default('1');
			$table->bigInteger('genealogy_id');
			$table->bigInteger('relagen_id');
			$table->bigInteger('national_id');
			$table->bigInteger('gander_id');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('deceased');
	}
}