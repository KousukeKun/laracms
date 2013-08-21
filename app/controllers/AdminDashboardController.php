<?php
class AdminDashboardController extends AdminController {

    public function getIndex()
    {
        $this->theme->setTitle('Admin Dashboard');
        return $this->theme->of('admin.dashboard', $this->data)->render();
    }
}