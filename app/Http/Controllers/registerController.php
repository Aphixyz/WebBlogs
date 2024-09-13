<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function registerfrom()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่
        if (empty($request->input('name')) || empty($request->input('email')) || empty($request->input('password')) || empty($request->input('password_confirmation'))) {
            return redirect()->back()->with('error', 'กรุณากรอกข้อมูลให้ครบ');
        }

        // ตรวจสอบว่ารหัสผ่านตรงกันหรือไม่
        if ($request->input('password') !== $request->input('password_confirmation')) {
            return redirect()->back()->with('error', 'รหัสผ่านไม่ตรงกัน');
        }

        // ตรวจสอบว่าชื่อผู้ใช้หรืออีเมลมีอยู่แล้วหรือไม่
        if (User::where('name', $request->input('name'))->exists()) {
            return redirect()->back()->with('error', 'ชื่อผู้ใช้นี้มีอยู่แล้ว');
        } elseif (User::where('email', $request->input('email'))->exists()) {
            return redirect()->back()->with('error', 'อีเมลนี้มีอยู่แล้ว');
        }

        // Validation ของ Laravel
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // สร้างบัญชีผู้ใช้ใหม่
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'status' => 0, // ตั้งค่า status เป็น 0
        ]);
        return redirect()->route('login.form')->with('success', 'สร้างบัญชีผู้ใช้เรียบร้อย');
    }
}
