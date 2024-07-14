<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutTheOfficeOfCemeteriesAffairTable extends Migration {

	public function up()
	{
		Schema::create('about_the_office_of_cemeteries_affair', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('image');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('news');
	}
}