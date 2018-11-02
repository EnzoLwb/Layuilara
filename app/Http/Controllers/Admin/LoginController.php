<?php

namespace App\Http\Controllers\Admin;

use App\Models\Site;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // 登录页面验证码标记
    protected $captchaAdminLogin = false;

    public function __construct() {
        parent::__construct();
        $captcha = Site::where('key','captcha')->value('value');
        isset($captcha) && $captcha==1 && $this->captchaAdminLogin = true;
    }

    /**
     * 登录表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login_register.login',[
            'captcha' => $this->captchaAdminLogin
        ]);
    }

    protected function validateLogin(Request $request){
        $rules = [
            $this->username() => 'required',
            'password' => 'required',
        ];
        // 添加验证码
        if ($this->captchaAdminLogin === true) {
            $rules['captcha'] = 'required|captcha';
            $this->validate($request, $rules,[
                'captcha.required' => '请填写验证码',
                'captcha.captcha' => '验证码错误',
            ]);
        }else{
            $this->validate($request, $rules);
        }
    }
    /**
     * 用于登录的字段
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * 登录成功后的跳转地址
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectTo()
    {
        return route('admin.layout');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(route('admin.login'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
