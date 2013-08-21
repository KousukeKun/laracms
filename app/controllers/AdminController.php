<?php
class AdminController extends BaseController {

    protected $theme, $data;

    public function __construct()
    {
        $this->data = array();

        if (get_class($this) == 'AdminAuthController')
        {
            $this->theme = Theme::uses('admin')->layout('admin-auth');
        }
        else
        {
            $this->theme = Theme::uses('admin')->layout('admin-dashboard');
        }
    }
}