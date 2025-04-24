<?php

namespace App\Http\Controllers\shop;

use App\Http\Controllers\Controller; // Import the base Controller
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User; // Ensure the User model is imported
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('shop.home');
        }
        return view("shop.login");
    }

    public function dologin(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        $args = [
            ['status', '=', 1],
        ];

        // Determine if the input is an email or username
        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $args[] = ['email', '=', $username];
        } else {
            $args[] = ['username', '=', $username];
        }

        $user = User::where($args)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $request->has('remember'));
            
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->fullname,
                    'email' => $user->email
                ],
                'redirect' => route('shop.home')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Thông tin đăng nhập không chính xác'
        ], 401);
    }

    public function logout()
    {
        Auth::logout();
        session()->forget('user_site');
        return redirect()->route('shop.login')->with('success', 'Đăng xuất thành công');
    }


    public function registration()
    {
        return view('shop.registration');
    }
    // Xử lý đăng ký người dùng
    public function doregistration(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:user,username',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:male,female',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = new User();
        $user->password = bcrypt($request->password);
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->roles = 'customer';
        $user->created_by = 1;
        $user->created_at = now();
        $user->status = 1;

        // Handle thumbnail upload (same as before)
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $filename = now()->format('YmdHis') . '.' . $extension;
            $file->move(public_path('images/user'), $filename);
            $user->thumbnail = $filename;
        }

        // Save the user
        $user->save();

        return redirect()->route('shop.login')->with('success', 'Đăng ký tài khoản thành công!');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('shop.profile', compact('user'));
    }

    public function storeUserSession(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric'
        ]);

        session(['user_id' => $request->user_id]);
        return response()->json(['success' => true]);
    }

    public function clearUserSession()
    {
        session()->forget('user_id');
        return response()->json(['success' => true]);
    }
}
