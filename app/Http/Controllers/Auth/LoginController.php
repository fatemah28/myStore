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
    // protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    // protected function authenticated(Request $request, $user)
    // {
    //     // Check if the user is an admin
    //     if ($user->role === 'admin') {
    //         // if (session()->has('url.intended')) {
    //         //     return redirect()->intended(session('url.intended'));
    //         // }
    //         return redirect()->intended('/admin'); // Redirect admins to the admin dashboard
    //     }

    //     // Otherwise, redirect to the intended URL or the default home page
    //     return redirect()->intended($this->redirectTo);
    //     // if (session()->has('url.intended')) {
    //     //     return redirect()->intended(session('url.intended'));
    //     // }
    // }
}
