<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table)
	    {
	        $table->increments('id');
	        $table->text('title');
	        $table->string('slug', 255);
	        $table->longText('content');
	        $table->text('excerpt');
	        $table->enum('status', array('publish', 'draft'))->default('publish');
	        $table->timestamps();
	        $table->softDeletes();
	    });

	    Schema::create('post_category', function($table)
	    {
	    	$table->integer('post_id');
	    	$table->integer('category_id');
	    });

	    Schema::create('post_tag', function($table)
	    {
	    	$table->integer('post_id');
	    	$table->integer('tag_id');
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
		Schema::drop('post_category');
		Schema::drop('post_tag');
	}

}