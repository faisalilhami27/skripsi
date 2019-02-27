<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\KonfigurasiModel;
use App\Models\UserLevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
        $level = UserLevelModel::all();
        $title = "Halaman Pengguna";
        $deskripsi = "Halaman pengguna digunakan untuk mengelola data user";
        return view('user.userView', compact('title', 'deskripsi', 'level'));
    }

    public function datatable()
    {
        $data = UserModel::with('userLevel')->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(UserRequest $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $username = $request->username;
        $password = Hash::make($request->password);
        $level = $request->level;
        $status = $request->status;
        $images = $request->file('images');

        $insert = UserModel::create([
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'id_user_level' => $level,
            'status' => $status,
            'images' => $images->store(
                'img', 'public'
            )
        ]);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = UserModel::findOrFail($id);

        if ($data) {
            return response()->json(['status' => 200, 'user' => $data]);
        } else {
            return response()->json(['status' => 449, 'msg' => "Data tidak ditemukan"]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
           'level' => 'required',
           'status' => 'required'
        ]);

        $data = $request->all();
        $id = $request['id'];

        $update = UserModel::findOrFail($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = UserModel::findOrFail($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal dihapus']);
        }
    }

    public function resetPassword(Request $request)
    {
        $id = $request->id;
        $konfigurasi = KonfigurasiModel::get();

        $password = Hash::make($konfigurasi[7]->nilai_konfig);

        $data = [
          'password' => $password
        ];

        $reset = UserModel::findOrFail($id)->update($data);

        if ($reset) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil direset']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal direset']);
        }
    }

    public function cekUsername(Request $request)
    {
        $username = $request->username;
        $cekUsername = UserModel::where('username', $username)->get();
        $getEmail = $cekUsername->count();

        if ($getEmail == 1) {
            return response()->json(['status' => 449, 'msg' => 'username has been used']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'username available']);
        }
    }

    public function cekEmail(Request $request)
    {
        $email = $request->email;
        $cekUsername = UserModel::where('email', $email)->get();
        $getEmail = $cekUsername->count();

        if ($getEmail == 1) {
            return response()->json(['status' => 449, 'msg' => 'email has been used']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'email available']);
        }
    }
}
