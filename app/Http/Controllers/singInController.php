<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class singInController extends Controller
{
    public function loginfrom()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Attempt to log the user in
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            session()->put('message', $user->name);

            //admin
            if ($user->status == 1) {
                return redirect()->route('admin.active');
            } else if ($user->status == 0) {
                return redirect()->route('people.active');
            } else {
                return redirect()->route('/');
            }
        }

        return Redirect::back()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง')->withInput();
    }
}
