<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenealogyTable extends Migration {

	public function up()
	{
		Schema::create('genealogy', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('genealogy');
	}
}