<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanRequest;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class KaryawanController extends Controller
{

    public function index()
    {
        $idUserLevel = Session::get('id_user_level');
        $idMenu = getIdMenu();
        $akses = checkAccess($idUserLevel, $idMenu);
        $title = 'Halaman Data Karyawan';
        $deskripsi = 'Halaman data karyawan digunakan untuk mengelola karyawan';
        return view('karyawan.karyawanView', compact( 'title', 'deskripsi', 'akses'));
    }

    public function datatable()
    {
        $data = KaryawanModel::all();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(KaryawanRequest $request)
    {
        $nama = htmlspecialchars($request->nama);
        $email = htmlspecialchars($request->email);
        $noHp = htmlspecialchars($request->noHp);
        $status = $request->status;

        $insert = KaryawanModel::create([
            'nama' => $nama,
            'email' => $email,
            'no_hp' => $noHp,
            'status' => $status,
        ]);

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->id;

        $getData = KaryawanModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(KaryawanRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];

        $update = KaryawanModel::find($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = KaryawanModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
