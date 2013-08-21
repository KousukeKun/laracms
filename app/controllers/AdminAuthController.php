<?php
class AdminAuthController extends AdminController {

    public function getLogin()
    {
        $this->theme->setTitle('Admin Login');
        return $this->theme->of('admin.auth.login', $this->data)->render();
    }

    public function postLogin()
    {
        $credential = Input::only('username', 'password');

        if ( !Auth::attempt($credential) )
        {
            $errors = new MessageBag();
            $errors->add('auth_errors', 'Incorrect Username or Password.');

            return Redirect::to('admin/login')->withErrors($errors);
        }

        return Redirect::to('admin');
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to('admin/login');
    }
/*
    public function getSignup()
    {
        $this->theme->setTitle('Admin Signup');

        return $this->theme->of('admin.auth.signup', $this->data)->render();
    }

    public function postSignup()
    {
        $user_data = Input::only('username', 'password', 'password_confirmation', 'email');

        if ( User::validate($user_data) )
        {
            $user_data['password'] = Hash::make($user_data['password']);
            $user = User::create($user_data);

            $this->data['signup_success'] =  TRUE;
        }
        else
        {
            $this->data['validate_errors'] =  User::errors();
        }

        return $this->getSignup();
    }
*/
/*
    private function add_assets()
    {
        $this->theme->asset()->usePath()->add('bootstrap-css', 'bootstrap/css/bootstrap.min.css');
        $this->theme->asset()->usePath()->add('fonts-ptsans-style', 'css/fonts/ptsans/stylesheet.css');
        $this->theme->asset()->usePath()->add('fonts-icomoon-style', 'css/fonts/icomoon/style.css');
        $this->theme->asset()->usePath()->add('style-login', 'css/login.css');
        $this->theme->asset()->usePath()->add('style-mws-theme', 'css/mws-theme.css');
        $this->theme->asset()->usePath()->add('style-mws-style', 'css/mws-style.css');

        // JavaScript Plugins
        $this->theme->asset()->usePath()->add('jquery', 'js/libs/jquery-1.8.3.min.js');
        $this->theme->asset()->usePath()->add('jquery-placeholder', 'js/libs/jquery.placeholder.min.js');
        $this->theme->asset()->usePath()->add('custom-plugins-fileinput', 'custom-plugins/fileinput.js');

        // jQuery-UI Dependent Scripts
        $this->theme->asset()->container('footer')->usePath()->add('jui', 'jui/js/jquery-ui-effects.min.js');

        // Plugin Scripts
        $this->theme->asset()->container('footer')->usePath()->add('jquery-validate', 'plugins/validate/jquery.validate-min.js');

        // Login Script
        $this->theme->asset()->container('footer')->usePath()->add('js-login', 'js/core/login.js');
    }
*/
}