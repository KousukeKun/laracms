<?php

use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function($table)
	    {
	        $table->increments('id');
	        $table->integer('parent_id')->default(0);
	        $table->string('name', 255);
	        $table->string('slug', 255);
	        $table->text('detail');
	        $table->timestamps();
	        $table->softDeletes();
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}