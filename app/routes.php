<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Home */
Route::get('/', 'FrontController@home');

/* Admin */
Route::get('admin/logout',  array('as' => 'admin.logout',      'uses' => 'AdminAuthController@getLogout'));
Route::get('admin/login',   array('as' => 'admin.login',       'uses' => 'AdminAuthController@getLogin'));
Route::post('admin/login',  array('as' => 'admin.login.post',  'uses' => 'AdminAuthController@postLogin'));
Route::get('admin/signup',   array('as' => 'admin.signup',       'uses' => 'AdminAuthController@getSignup'));
Route::post('admin/signup',  array('as' => 'admin.signup.post',  'uses' => 'AdminAuthController@postSignup'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
    Route::controllers(array(
        'pages'  => 'AdminPagesController',
        'posts'  => 'AdminPostsController',
        'categories' => 'AdminCategoriesController',
        '/'      => 'AdminDashboardController'
    ));
});

/* Tag */
Route::get('tag/{slug}', 'FrontController@tag');

/*
|--------------------------------------------------------------------------
| Url Pattern for "Single Post"
| /category/1234.html
| /category/sub_category/5678.html
|
| Url Pattern for "Page" or "Category"
| /category
| /category/sub_category
| /page-slug
| /page-parent/page-child
|
| Warning - This Route Pattern Still have some problem !
| Because I had checked only last uri segement to define type of current page content,
| I just use Canonical URL to patches it.
|--------------------------------------------------------------------------
*/

Route::get('{uri}', function($uri) {
    $uri_segment = explode('/', $uri);
    $last_segment = end($uri_segment);

    $c = new FrontController();

    if (preg_match('!^[1-9][0-9]*\.html$!', $last_segment))
    {
        $post_id = (int) $last_segment;

        if ($post_id > 0)
        {
            return $c->singlePost( $post_id );
        }
    }

    $category = Category::where('slug', $last_segment)->first();
    if (!empty($category))
    {
        return $c->category( $last_segment );
    }

    $page = Page::where('slug', $last_segment)->first();
    if (!empty($page))
    {
        return $c->singlePage( $last_segment );
    }

    return App::abort(404);
})->where('uri', '([ก-ฮa-zA-Z0-9\-\._/]+)');