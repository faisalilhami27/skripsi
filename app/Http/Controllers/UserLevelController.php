<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLevelRequest;
use App\Models\MenuModel;
use App\Models\RoleLevelModel;
use App\Models\UserLevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserLevelController extends Controller
{

    public function index()
    {
        $title = "Halaman Level Pengguna";
        $deskripsi = "Halaman level pengguna digunakan untuk memberi hak akses untuk user";
        return view('userlevel.userLevelView', compact('title', 'deskripsi'));
    }

    public function datatable()
    {
        $userLevel = UserLevelModel::select("id", "nama_level")->get();
        return DataTables::of($userLevel)->addIndexColumn()->make(true);
    }

    public function store(UserLevelRequest $request)
    {
        $data = htmlspecialchars($request->nama_level);

        $insert = UserLevelModel::create($data);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function show(Request $request)
    {
        $params = $request->segment(3);
        $level = UserLevelModel::where('id', $params)->first();
        $menu = MenuModel::select('id', 'title')->paginate(5);
        $title = "Halaman Hak Akses";
        $deskripsi = "Halaman user level digunakan untuk memberi hak akses untuk user";
        return view('userlevel.akses', compact('title', 'deskripsi', 'menu', 'level'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = UserLevelModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(UserLevelRequest $request)
    {
        $data = htmlspecialchars($request->nama_level);
        $id = $request->id_user_level;

        $update = UserLevelModel::find($id)->update([
            'nama_level' => $data
        ]);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data berhasil diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = UserLevelModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal dihapus']);
        }
    }

    public function changePrivilege(Request $request)
    {
        $id_menu = $request->id_menu;
        $id_user_level = $request->level;

        $data = [
            'id_menu' => $id_menu,
            'id_user_level' => $id_user_level,
            'create' => 0,
            'read' => 0,
            'update' => 0,
            'delete' => 0
        ];

        $akses = RoleLevelModel::where('id_user_level', $id_user_level)
            ->where('id_menu', $id_menu)
            ->first();

        if ($akses == null) {
            $update = RoleLevelModel::create($data);
        } else {
            $update = DB::table('role_level')
                ->where('id_menu', $id_menu)
                ->where('id_user_level', $id_user_level)
                ->delete();
        }
        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'Data gagal diubah']);
        }
    }

    public function updateAccess(Request $request)
    {
        $value = $request->value;
        $field = $request->field;
        $id_user_level = $request->level;
        $id_menu = $request->id_menu;

        if ($field == 'create') {
            $data = [
                'create' => $value
            ];
        } else if ($field == 'read') {
            $data = [
                'read' => $value
            ];
        } else if ($field == 'update') {
            $data = [
                'update' => $value
            ];
        } else if ($field == 'delete') {
            $data = [
                'delete' => $value
            ];
        }

        $update = RoleLevelModel::where('id_user_level', $id_user_level)
            ->where('id_menu', $id_menu)
            ->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'Data gagal diubah']);
        }
    }
}
