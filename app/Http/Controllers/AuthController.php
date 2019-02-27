<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        $title = "Halaman Login";
        return view('auth.auth', compact('title'));
    }

    public function checkLogin(AuthRequest $request)
    {
        $username = htmlspecialchars($request->username);
        $password = htmlspecialchars($request->password);
        $user = UserModel::where('username', $username)->first();
        if (is_null($user['username'])){
            return response()->json(['status' => 449, 'msg' => 'Username anda tidak terdaftar']);
        } else {
            if ($user['status'] == "y") {
                if ($user->count() > 0) {
                    if (Hash::check($password, $user['password'])) {
                        Session::put('id_users', $user->id);
                        Session::put('nama_lengkap', $user->nama);
                        Session::put('email', $user->email);
                        Session::put('images', $user->images);
                        Session::put('id_user_level', $user->id_user_level);
                        Session::put('is_aktif', $user->status);
                        Session::put('login', TRUE);
                        return response()->json(['status' => 200, 'msg' => 'Login berhasil akan diarahkan ke halaman utama']);
                    } else {
                        return response()->json(['status' => 449, 'msg' => 'Password yang anda inputkan salah']);
                    }
                } else {
                    return response()->json(['status' => 449, 'msg' => 'Password yang anda inputkan salah']);
                }
            } else {
                return response()->json(['status' => 449, 'msg' => 'Akun anda dinonaktifkan']);
            }
        }
    }

    public function blokir()
    {
        return view('blokir');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->back();
    }
}
