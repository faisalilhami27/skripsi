<?php

namespace App\Http\Controllers;

use App\Models\ChooseRoleModel;
use App\Models\KaryawanModel;
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
        $user = UserModel::with('karyawan')
            ->where('id', $id)
            ->first();
        $level = ChooseRoleModel::with('roleMany')
            ->where('id_karyawan', $id)
            ->get();

        $array = [];
        $i = 1;
        foreach ($level as $item) {
            foreach ($item->roleMany as $r) {
                $array[$i] = $r->nama_level;
            }
            $i++;
        }
        $data = @implode(', ', $array);
        $explode = @explode(",", $data);
        $size = sizeof($explode);
        if ($size > 2) {
            $implode = "Memiliki " . $size . " Hak Akses";
        } else {
            $implode = $data;
        }

        $title = "Halaman Profile";
        $deskripsi = "Halaman profile digunakan untuk mengelola identitas user";
        return view('profile', compact('title', 'deskripsi', 'user', 'implode'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:60|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|email|max:60',
            'no_hp' => 'required|numeric',
            'username' => 'required|max:60|regex:/^[a-zA-Z0-9.-_ ]*$/',
        ]);

        $nama = htmlspecialchars($request->nama);
        $username = htmlspecialchars($request->username);
        $email = htmlspecialchars($request->email);
        $noHp = htmlspecialchars($request->no_hp);
        $id = Session::get('id_users');
        $file = $request->file('images');

        if (!is_null($file)) {
            $user = UserModel::find($id)->first();
            $images = $user->images;

            if (is_null($images)) {

                KaryawanModel::where('id', $user->id_karyawan)->update([
                    'nama' => $nama,
                    'email' => $email,
                    'no_hp' => $noHp
                ]);

                $update = UserModel::findOrFail($id)->update([
                    'username' => $username,
                    'images' => $file->store(
                        'img', 'public'
                    )
                ]);
            } else {
                $pathDelete = "storage/" . $images;
                unlink($pathDelete);

                KaryawanModel::where('id', $user->id_karyawan)->update([
                    'nama' => $nama,
                    'email' => $email,
                    'no_hp' => $noHp
                ]);

                $update = UserModel::findOrFail($id)->update([
                    'username' => $username,
                    'images' => $file->store(
                        'img', 'public'
                    )
                ]);
            }
            Session::put('images', $file->store(
                'img', 'public'
            ));
        } else {
            $update = KaryawanModel::findOrFail($id)->update([
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
