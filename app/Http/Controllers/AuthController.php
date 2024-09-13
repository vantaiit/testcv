<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm() {
        return view('login'); // Tên view cho form đăng nhập
    }

    // Xử lý đăng nhập
    public function login(Request $request) {


        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);


        // Thử đăng nhập bằng tên người dùng hoặc email
        if (Auth::attempt(['username' => $credentials['username'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // Điều hướng đến dashboard
        }

        // Flash message đăng nhập thất bại
        return back()->withErrors([
            'username' => 'These credentials do not match our records.',
        ])->withInput();


    }

    // Hiển thị form đăng ký
    public function showRegisterForm() {
        return view('register'); // Tên view cho form đăng ký
    }

    // Xử lý đăng ký
    public function register(Request $request) {

        // dd($request);
        $validated = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);



        // Tạo user mới
        $user = User::create([
            'name' => $validated['fullname'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
        ]);

        // Đăng nhập sau khi đăng ký thành công
        Auth::login($user);

        // Flash message đăng ký thành công
        return redirect('/dashboard')->with('success', 'Registration successful!');
    }


    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Flash message đăng xuất thành công
        return redirect('/login')->with('success', 'Logout successful!');
    }


    // Hiển thị dashboard sau khi đăng nhập thành công
    public function dashboard() {
        return view('dashboard'); // View cho trang dashboard
    }
}
