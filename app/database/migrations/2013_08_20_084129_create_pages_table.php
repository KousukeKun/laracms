<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pages', function($table)
	    {
	        $table->increments('id');
	        $table->integer('parent_id')->default(0);
	        $table->text('title');
	        $table->string('slug', 255);
	        $table->longText('content');
	        $table->text('excerpt');
	        $table->enum('status', array('publish', 'draft'))->default('publish');
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
		Schema::drop('pages');
	}

}