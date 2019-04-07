<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\ChooseRoleModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

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
        $user = UserModel::with('karyawan')
            ->where('username', $username)->first();
        if (is_null($user)) {
            return response()->json(['status' => 500, 'msg' => 'Akun anda sudah dihapus oleh pihak perusahaan']);
        } else if (is_null($user['username'])) {
            return response()->json(['status' => 500, 'msg' => 'Username anda tidak terdaftar']);
        } else {
            if ($user['status'] == "y") {
                if ($user->count() > 0) {
                    if (Hash::check($password, $user['password'])) {
                        $chooseRole = ChooseRoleModel::with('roleMany')
                            ->where('id_karyawan', $user->id)
                            ->get();
                        if ($chooseRole->count() == 1) {
                            Session::put('id_user_level', $chooseRole[0]->id_user_level);
                        }
                        Session::put('id_users', $user->id);
                        Session::put('nama_lengkap', $user->karyawan->nama);
                        Session::put('email', $user->karyawan->email);
                        Session::put('images', $user->images);
                        Session::put('is_aktif', $user->status);
                        Session::put('login', TRUE);
                        Session::put('count', $chooseRole->count());
                        return response()->json(['status' => 200, 'msg' => 'Login berhasil akan diarahkan ke halaman utama', 'count' => $chooseRole->count()]);
                    } else {
                        return response()->json(['status' => 500, 'msg' => 'Password yang anda inputkan salah']);
                    }
                } else {
                    return response()->json(['status' => 500, 'msg' => 'Password yang anda inputkan salah']);
                }
            } else {
                return response()->json(['status' => 500, 'msg' => 'Akun anda dinonaktifkan']);
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
        return redirect(URL::previous());
    }
}
