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

        $insert = UserLevelModel::create([
            'nama_level' => $data
        ]);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function getMenu()
    {
        $menu = MenuModel::get();
        return response()->json($menu);
    }

    public function show(Request $request)
    {
        $params = $request->segment(3);
        $level = UserLevelModel::where('id', $params)->first();
        $title = "Halaman Hak Akses";
        $deskripsi = "Halaman user level digunakan untuk memberi hak akses untuk user";
        return view('userlevel.akses', compact('title', 'deskripsi', 'level', 'params'));
    }

    public function datatable2($id)
    {
        $menu = MenuModel::select('id', 'title')->get();
        return DataTables::of($menu)->addIndexColumn()
            ->addColumn('akses', function ($query) use ($id) {
                return "<label class='switch switch-primary'>
                            <input class='switch-input change' type='checkbox' id='" . $query->id . "' " . beriAkses($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
            })
            ->addColumn('create', function ($query) use ($id) {
                $akses = cekAkses($id, $query->id);
                if ($akses == 0) {
                    return "<label class='switch switch-success'>
                            <input class='switch-input create" . $query->id . "' type='checkbox' disabled id='" . $query->id . "' " . create($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                } else {
                    return "<label class='switch switch-success'>
                            <input class='switch-input create" . $query->id . "' type='checkbox' id='" . $query->id . "' " . create($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                }
            })
            ->addColumn('read', function ($query) use ($id) {
                $akses = cekAkses($id, $query->id);
                if ($akses == 0) {
                    return "<label class='switch switch-warning'>
                            <input class='switch-input read" . $query->id . "' type='checkbox' disabled id='" . $query->id . "' " . read($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                } else {
                    return "<label class='switch switch-warning'>
                            <input class='switch-input read" . $query->id . "' type='checkbox' id='" . $query->id . "' " . read($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                }
            })
            ->addColumn('update', function ($query) use ($id) {
                $akses = cekAkses($id, $query->id);
                if ($akses == 0) {
                    return "<label class='switch switch-info'>
                            <input class='switch-input update" . $query->id . "' type='checkbox' disabled id='" . $query->id . "' " . update($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                } else {
                    return "<label class='switch switch-info'>
                            <input class='switch-input update" . $query->id . "' type='checkbox' id='" . $query->id . "' " . update($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                }
            })
            ->addColumn('delete', function ($query) use ($id) {
                $akses = cekAkses($id, $query->id);
                if ($akses == 0) {
                    return "<label class='switch switch-danger'>
                            <input class='switch-input delete" . $query->id . "' type='checkbox' disabled id='" . $query->id . "' " . delete($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                } else {
                    return "<label class='switch switch-danger'>
                            <input class='switch-input delete" . $query->id . "' type='checkbox' id='" . $query->id . "' " . delete($id, $query->id) . ">
                            <span class='switch-track'></span>
                            <span class='switch-thumb'></span>
                        </label>";
                }
            })
            ->rawColumns(['akses', 'create', 'read', 'update', 'delete'])->make(true);
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = UserLevelModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
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
            return response()->json(['status' => 500, 'msg' => 'Data berhasil diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = UserLevelModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }

    public function changePrivilege(Request $request)
    {
        $idMenu = $request->id_menu;
        $idUserLevel = $request->level;

        $data = [
            'id_menu' => $idMenu,
            'id_user_level' => $idUserLevel,
            'create' => 0,
            'read' => 0,
            'update' => 0,
            'delete' => 0
        ];

        $akses = RoleLevelModel::where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->first();

        if (is_null($akses)) {
            $update = RoleLevelModel::create($data);
        } else {
            $update = DB::table('role_level')
                ->where('id_menu', $idMenu)
                ->where('id_user_level', $idUserLevel)
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
        $idUserLevel = $request->level;
        $idMenu = $request->id_menu;

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

        $update = RoleLevelModel::where('id_user_level', $idUserLevel)
            ->where('id_menu', $idMenu)
            ->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 200, 'msg' => 'Data gagal diubah']);
        }
    }
}
