<?php namespace crocodicstudio\crudbooster\controllers;

use crocodicstudio\crudbooster\exceptions\CBValidationException;
use Illuminate\Support\Facades\Cache;

class AdminAuthController extends CBController
{

    public function getLogin()
    {
        if(!auth()->guest()) return redirect(cb()->getAdminUrl());

        cbHook()->hookGetLogin();

        return view(config('crudbooster.LOGIN_FORM_VIEW'));
    }

    public function postLogin()
    {
        try{
            cb()->validation([
                'email'=>'required|email',
                'password'=>'required'
            ]);
            $credential = request()->only(['email','password']);
            if (auth()->attempt($credential)) {
                cbHook()->hookPostLogin();
                return redirect(cb()->getAdminUrl());
            } else {
                return redirect(cb()->getLoginUrl())->with(['message'=>__('crudbooster.alert_password_wrong'),'message_type'=>'warning']);
            }
        }catch (CBValidationException $e) {
            return cb()->redirect(cb()->getAdminUrl("login"),$e->getMessage(),'warning');
        }
    }

    public function getLogout()
    {
        auth()->logout();
        return cb()->redirect(cb()->getAdminUrl("login"), __('crudbooster.message_after_logout'), 'success');
    }

    public function getLoginDeveloper() {
        return view('crudbooster::dev_layouts.login');
    }

    public function postLoginDeveloper() {
        try{
            cb()->validation([
                'username'=>'required',
                'password'=>'required'
            ]);

            if(request('username') == config('crudbooster.DEV_USERNAME')
                && request('password') == Cache::get("developer_password")) {

                session(['developer'=>1]);

                return redirect(cb()->getDeveloperUrl());

            }else{
                return cb()->redirectBack("Username and or password is wrong!");
            }

        }catch (CBValidationException $e) {
            return cb()->redirect(cb()->getLoginUrl(),$e->getMessage(),'warning');
        }
    }

    public function getLogoutDeveloper() {
        session()->forget("developer");

        return redirect(cb()->getAdminUrl("login"));
    }
}
