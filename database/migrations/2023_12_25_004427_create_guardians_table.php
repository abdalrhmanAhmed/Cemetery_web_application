<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuardiansTable extends Migration {

	public function up()
	{
		Schema::create('guardians', function(Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->string('phone_number', 20);
			$table->string('email', 255);
			$table->string('address', 255);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('guardians');
	}
}