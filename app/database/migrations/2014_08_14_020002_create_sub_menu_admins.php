<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubMenuAdmins extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sub_menu_admins', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name_sub_menu',100);
			$table->string('icon_sub_menu',100);
			$table->integer('Parent_menu_id');
			$table->integer('Level_sub_menu');
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
		Schema::drop('sub_menu_admins');
	}

}
