<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    // Chuyển hướng người dùng đến trang đăng nhập Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Xử lý callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Failed to authenticate with Google.']);
        }

        // Kiểm tra xem người dùng đã tồn tại trong cơ sở dữ liệu chưa
        $user = User::where('username', $googleUser->getEmail())->first();

        if (!$user) {
            // Nếu người dùng chưa tồn tại, tạo tài khoản mới
            $user = User::create([
                'name' => $googleUser->getName(),
                'username' => $googleUser->getEmail(),
                'password' => bcrypt('google_oauth'),  // Mật khẩu giả lập, không thực sự cần thiết vì dùng Google OAuth
            ]);
        }

        // Đăng nhập người dùng
        Auth::login($user, true);

        // Chuyển hướng người dùng đến trang dashboard
        return redirect('/dashboard')->with('success', 'Logged in with Google!');
    }
}
