<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('auth.login_new');
    }

    public function login(Request $request)
    {
        // die('Login function hit');
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = DB::table('audit_user_header_all')->where('email', $request->email)->first();
// dd($user);
        // if ($user && Hash::check($request->password, $user->password)) {
        if ($user && $user->password == $request->password) {
            session(['user' => $user]);
            return redirect()->route('admin.admin_list');
        }

        return back()->withErrors(['login_error' => 'Invalid email or password']);
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('login.form');
    }
}
