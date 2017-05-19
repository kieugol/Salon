<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuAdmins extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('menu_admins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name_menu',100);
			$table->string('icon_menu',100);
			$table->string('link_menu',100);
			$table->integer('Level_menu');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('menu_admins');
	}

}
