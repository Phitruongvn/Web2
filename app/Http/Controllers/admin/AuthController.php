<?php

namespace App\Http\Controllers\admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    function login()
    {
        // If already logged in and is admin, redirect to admin home
        if (Auth::check() && Auth::user()->roles === 'admin') {
            return redirect()->route('admin.home');
        }
        return view("admin.user.login");
    }

    function dologin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->roles === 'admin') {
                // Store user info in session
                session([
                    'admin_id' => $user->id,
                    'admin_name' => $user->name,
                    'admin_email' => $user->email,
                    'admin_fullname' => $user->fullname
                ]);

                $request->session()->regenerate();
                return redirect()->route('admin.home')
                    ->with('success', 'Đăng nhập thành công!');
            }
            
            // If not admin, logout and return with error
            Auth::logout();
            return redirect()->route('admin.login')
                ->with('error', 'Bạn không có quyền truy cập vào trang admin!');
        }

        return redirect()->route('admin.login')
            ->with('error', 'Email hoặc mật khẩu không chính xác!');
    }

    function logout()
    {
        // Clear admin session data
        session()->forget(['admin_id', 'admin_name', 'admin_email', 'admin_fullname']);
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login')
            ->with('success', 'Đăng xuất thành công!');
    }

    // API endpoint for getting current user info
    public function getCurrentUser()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return response()->json([
                'isAuthenticated' => true,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'fullname' => $user->fullname,
                    'roles' => $user->roles
                ]
            ]);
        }
        return response()->json(['isAuthenticated' => false]);
    }
}
