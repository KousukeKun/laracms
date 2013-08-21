<?php
class FrontController extends BaseController {

    public function home()
    {
        echo 'Home';
    }

    public function category( $slug = '' )
    {
        echo 'Category - ' . $slug;
    }

    public function singlePage( $slug = '' )
    {
        echo 'Page - ' . $slug;
    }

    public function singlePost( $id = 0 )
    {
        echo 'Single - ' . $id;
    }

    public function tag( $slug = '' )
    {
        echo 'Tag - ' . $slug;
    }
    
}