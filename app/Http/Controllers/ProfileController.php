<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$request->session()->get('login')) {
                return redirect('auth');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $id = Session::get('id_users');
        $user = UserModel::with('userLevel')
            ->where('id', $id)
            ->first();
        $title = "Halaman Profile";
        $deskripsi = "Halaman profile digunakan untuk mengelola identitas user";
        return view('profile', compact('title','deskripsi', 'user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:60|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:60',
            'username' => 'required|max:60|regex:/^[a-zA-Z0-9.-_ ]*$/',
        ]);

        $nama = htmlspecialchars($request->nama);
        $username = htmlspecialchars($request->username);
        $email = htmlspecialchars($request->email);
        $id = Session::get('id_users');
        $file = $request->file('images');

        if (!is_null($file)) {
            $user = UserModel::find($id)->first();
            $images = $user->images;

            if (is_null($images)) {
                $update = UserModel::findOrFail($id)->update([
                    'nama' => $nama,
                    'username' => $username,
                    'email' => $email,
                    'images' => $file->store(
                        'img','public'
                    )
                ]);
            } else {
                $pathDelete = "storage/" . $images;
                unlink($pathDelete);

                $update = UserModel::findOrFail($id)->update([
                    'nama' => $nama,
                    'email' => $email,
                    'username' => $username,
                    'images' => $file->store(
                        'img','public'
                    )
                ]);
            }
            Session::put('images', $file->store(
                'img','public'
            ));
        } else {
            $update = UserModel::findOrFail($id)->update([
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
            ]);

            Session::put('nama_lengkap', $nama);
            Session::put('email', $email);
            Session::put('username', $username);
        }

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|max:12',
            'password_confirmation' => 'required|min:8|max:12',
        ]);

        $id = Session::get('id_users');
        $password = $request->password;
        $konfirmasiPassword = $request->password_confirmation;

        if (empty($password) || empty($konfirmasiPassword)) {
            $json = ["status" => 449, "msg" => "Password dan Konfirmasi Password harus diisi"];
        } elseif ($password != $konfirmasiPassword) {
            $json = ["status" => 449, "msg" => "Password dan Konfirmasi Password harus sama"];
        } elseif (strlen($password) < 8) {
            $json = ["status" => 449, "msg" => "Password minimal 8 karakter"];
        } else {
            UserModel::findOrFail($id)->update([
                'password' => Hash::make($password),
            ]);
            $json = ["status" => 200, "msg" => "Password berhasil diubah"];
        }
        return response()->json($json);
    }
}
