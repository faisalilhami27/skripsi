<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\ChooseRoleModel;
use App\Models\KaryawanModel;
use App\Models\KonfigurasiModel;
use App\Models\UserLevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
//        $data = ChooseRoleModel::with(['user' => function ($query) {
//        }])
//            ->where('id_karyawan', 1)
//            ->get();
//        $item = [];
//        $i = 0;
//        foreach ($data as $d) {
//            $item[$i] = $d->id_user_level;
//            $i++;
//        }
//        print_r($item); die;
//        $data = UserModel::with('karyawan', 'karyawanRole.role')->get();
//        $merge = [];
//        $i = 0;
//        foreach ($data as $item) {
//            foreach ($item->roleKaryawan as $r) {
//                $merge[$i] = $r;
////                foreach ($r->role as $test) {
////                    $merge[$i] = $test->nama_level;
////                }
//                $i++;
//            }
//        }
////        $implode = @implode(',', $merge);
////        $explode = @explode(' ', $merge);
////        foreach ($explode as $item) {
////            $test = $item;
////        }
//        echo json_encode($data); die;
        $user = KaryawanModel::all();
        $level = UserLevelModel::all();
        $title = "Halaman Pengguna";
        $deskripsi = "Halaman pengguna digunakan untuk mengelola data user";
        return view('user.userView', compact('title', 'deskripsi', 'level', 'user'));
    }

    public function datatable()
    {
        $data = UserModel::with('karyawan', 'karyawanRole.role')->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(UserRequest $request)
    {
        $karyawan = $request->karyawan;
        $username = $request->username;
        $password = Hash::make($request->password);
        $level = @explode(',', $request->level);
        $status = $request->status;
        $images = $request->file('images');

        $cekUser = UserModel::where('id_karyawan', $karyawan)->first();

        if ($cekUser['id_karyawan'] == $karyawan) {
            return response()->json(['status' => 449, 'msg' => 'Akun sudah ada pada sistem']);
        }

        foreach ($level as $item) {
            ChooseRoleModel::create([
                'id_karyawan' => $karyawan,
                'id_user_level' => $item
            ]);
        }

        $insert = UserModel::create([
            'username' => $username,
            'id_karyawan' => $karyawan,
            'password' => $password,
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
        $level = ChooseRoleModel::with(['user' => function ($query) use($id) {
        }])
            ->where('id_karyawan', $id)
            ->get();
        $user = UserModel::findOrFail($id);
        $item = [];
        $i = 0;
        foreach ($level as $d) {
            $item[$i] = $d->id_user_level;
            $i++;
        }

        if ($level) {
            return response()->json(['status' => 200, 'level' => $item, 'user' => $user]);
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

        $status = $request->status;
        $level = @explode(',', $request->level);
        $id = $request->id;

        $update = UserModel::findOrFail($id);

        ChooseRoleModel::where('id_karyawan', $update->id)->delete();

        foreach ($level as $item) {
            ChooseRoleModel::create([
                'id_karyawan' => $update->id,
                'id_user_level' => $item
            ]);
        }

        $update->update([
            'status' => $status
        ]);

        $chooseRole = ChooseRoleModel::with('roleMany')
            ->where('id_karyawan', $update->id)
            ->get();

        Session::put('count', $chooseRole->count());
        
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
        $cekUsername = KaryawanModel::where('email', $email)->get();
        $getEmail = $cekUsername->count();

        if ($getEmail == 1) {
            return response()->json(['status' => 449, 'msg' => 'email has been used']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'email available']);
        }
    }

    public function cekNoHp(Request $request)
    {
        $noHp = $request->noHp;
        $cekUsername = KaryawanModel::where('no_hp', $noHp)->get();
        $getNoHp = $cekUsername->count();

        if ($getNoHp == 1) {
            return response()->json(['status' => 449, 'msg' => 'No Handphone has been used']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'No Handphone available']);
        }
    }
}
