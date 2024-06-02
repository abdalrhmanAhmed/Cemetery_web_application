<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibraresDetailsTable extends Migration {

	public function up()
	{
		Schema::create('librares_details', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('library_id');
			$table->text('text')->nullable();
			$table->string('image', 255)->nullable();
			$table->string('video', 255)->nullable();
			$table->string('voice', 255)->nullable();
			$table->bigInteger('created_by');
			$table->bigInteger('updated_by')->default('0');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('librares_details');
	}
}