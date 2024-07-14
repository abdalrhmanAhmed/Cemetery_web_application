<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsDetailsTable extends Migration {

	public function up()
	{
		Schema::create('news_details', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('news_id');
			$table->string('type');
			$table->text('value');
			$table->boolean('status');
			$table->bigInteger('created_by');
			$table->bigInteger('updated_by');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('news_details');
	}
}