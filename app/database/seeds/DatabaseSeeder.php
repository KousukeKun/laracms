<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('PageTableSeeder');
		$this->call('PostTableSeeder');
		$this->call('CategoryTableSeeder');

        $this->command->info('User, Page, Post and Category table seeded!');
	}

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

    	$userData = array(
    		'username' => 'kousuke',
    		'password' => Hash::make('oki6xsasu'),
    		'email' => 'tontosapon@gmail.com'
    	);

        User::create($userData);
    }

}

class PageTableSeeder extends Seeder {

    public function run()
    {
        DB::table('pages')->delete();
        
    	$pageData = array(
    		'title' => 'About Us',
    		'slug' => 'about-us',
    		'content' => 'Hello, This is About Us Page Content.',
    		'excerpt' => 'This is About Us Page Excerpt.'
    	);

        Page::create($pageData);
    }

}

class PostTableSeeder extends Seeder {

    public function run()
    {
        DB::table('posts')->delete();
        
    	$postData = array(
    		'title' => 'Hello World',
    		'slug' => 'hello-world',
    		'content' => 'Hello World, Welcome to Laravel CMS',
    		'excerpt' => 'Hello World Excerpt'
    	);

        Post::create($postData);

        DB::table('post_category')->delete();
        DB::table('post_category')->insert(array('post_id' => 1, 'category_id' => 1));
    }

}

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();
        
    	$catData = array(
    		'name' => 'Uncategorized',
    		'slug' => 'uncategorized',
    		'detail' => 'uncategorized...'
    	);

        Category::create($catData);
    }

}