<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCemeterySitesDetailsTable extends Migration {

	public function up()
	{
		Schema::create('cemetery_sites_details', function(Blueprint $table) {
			$table->id();
			$table->bigInteger('cemetery_sites_id');
			$table->string('value');
			$table->string('type');
			$table->boolean('status')->default('1');
			$table->bigInteger('created_by')->default('0');
			$table->bigInteger('updated_by');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('cemetery_sites_details');
	}
}