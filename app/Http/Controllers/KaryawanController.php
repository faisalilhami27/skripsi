<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanRequest;
use App\Models\KaryawanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
        $title = 'Halaman Data Karyawan';
        $deskripsi = 'Halaman data karyawan digunakan untuk mengelola karyawan';
        return view('karyawan.karyawanView', compact( 'title', 'deskripsi'));
    }

    public function datatable()
    {
        $data = KaryawanModel::all();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(KaryawanRequest $request)
    {
        $nama = $request->nama;
        $email = $request->email;
        $noHp = $request->noHp;

        $insert = KaryawanModel::create([
            'nama' => $nama,
            'email' => $email,
            'no_hp' => $noHp
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

        $getData = KaryawanModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data tidak ditemukan']);
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
            return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = KaryawanModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal dihapus']);
        }
    }
}
