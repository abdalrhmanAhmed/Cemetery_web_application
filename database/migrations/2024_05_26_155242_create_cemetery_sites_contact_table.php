<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemeterySitesContactTable extends Migration {

	public function up()
	{
		Schema::create('cemetery_sites_contact', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('cemetery_sites_id');
			$table->string('type');
			$table->string('images');
			$table->string('info');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cemetery_sites_contact');
	}
}