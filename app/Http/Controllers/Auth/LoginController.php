<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/snap';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    public function username(){
        return 'ak_user_email';
    }
    public function login(Request $request)
    {   
        dd($this);

        $this->validate($request, [
            'ak_user_email' => 'required|email',
            'ak_user_password' => 'required',
        ]);

        $credentials = $request->only('ak_user_email', 'ak_user_password');
        if ($this->auth->attempt($credentials, $request->has('remember')))
        {
            return redirect()->intended($this->redirectPath());
        }

        return redirect($this->loginPath())
            ->withInput($request->only('ak_user_email', 'remember'))
            ->withErrors([
                'ak_user_email' => $this->getFailedLoginMessage(),
            ]);
    }

}
