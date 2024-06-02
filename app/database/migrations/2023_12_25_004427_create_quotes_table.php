<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration {

	public function up()
	{
		Schema::create('quotes', function(Blueprint $table) {
			$table->id();
			$table->string('title', 255);
			$table->string('sub_title', 255);
			$table->text('text');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('quotes');
	}
}