<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 15; // Default is 1
    // needs to be reviewed
    public function viewLogin()
    {
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ];

        $message = [
            'email.required' => 'البريد الإلكترني مطلوب',
            'email.email' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'email.exists' => 'الرجاء ادخال البريد الإلكتروني بشكل صحيح',
            'password.required' => 'كلمة المرور مطلوبة'
        ];


        $data = validator()->make($request->all(), $rules, $message);

        if ($data->fails()) {
            return back()->withInput()->withErrors($data->errors());
        } else {
            $remember = $request->input('remember') && $request->remember == 1 ? $request->remember : 0;
            if (auth()->guard('admin')->attempt(['email' => $request->email , 'password' => $request->password], $remember)) {
                return back();
            } else {
                return back()->withInput()->withErrors(['email' => 'خطأ في البريد الإلكتروني أو كلمة المرور']);
            }
        }
    }
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return back();
    }


    public function home()
    {
        return view('admin.layouts.home');
    }
}
