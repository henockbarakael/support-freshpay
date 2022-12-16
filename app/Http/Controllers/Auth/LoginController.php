<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login');
    }

    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if(Auth::attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (Auth::user()->is_user == 1) {
                Toastr::success('Login successfuly','Success');
                return redirect()->route('admin.dashboard');
            }
            elseif (Auth::user()->is_user == 2) {
                Toastr::success('Login successfuly','Success');
                return redirect()->route('finance.dashboard');
            }
            elseif (Auth::user()->is_user == 3) {
                Toastr::success('Login successfuly','Success');
                return redirect()->route('support_1.dashboard');
            }
            elseif (Auth::user()->is_user == 4) {
                Toastr::success('Login successfuly','Success');
                return redirect()->route('support_2.dashboard');
            }
            elseif (Auth::user()->is_user == 5) {
                Toastr::success('Login successfuly','Success');
                return redirect()->route('support_3.dashboard');
            }
            else{
                Toastr::error('Something Wrong','Error');
            return redirect()->route('login');
            }
        }else{
            Toastr::error('Email-Address And Password Are Wrong','Error');
            return redirect()->route('login');
        }
          
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Toastr::success('Déconnecter avec succès :)','Succès');
        return redirect('/');
    }
}
