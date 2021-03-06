<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonfigurasiMobileRequest;
use App\Models\KonfigurasiMobileModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KonfigurasiMobileController extends Controller
{

    public function index()
    {
        $title = 'Halaman Konfigurasi Mobile';
        $deskripsi = 'Halaman konfigurasi mobile digunakan untuk mengelola content berita untuk aplikasi mobile';
        return view('konfigurasimobile.konfigurasiMobileView', compact('title', 'deskripsi'));
    }

    public function datatable()
    {
        $data = KonfigurasiMobileModel::select("id", "title", "images", "deskripsi")->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(KonfigurasiMobileRequest $request)
    {
        $title = htmlspecialchars($request->title);
        $deskripsi = htmlspecialchars($request->deskripsi);
        $images = $request->file('images');
        $insert  = KonfigurasiMobileModel::create([
            'title' => $title,
            'deskripsi' => $deskripsi,
            'images' => $images->store('img', 'public')
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

        $getData = KonfigurasiMobileModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|max:40|regex:/^[a-zA-Z0-9 ]*$/',
            'deskripsi' => 'required|max:100',
        ]);

        $id = $request->id;
        $title = htmlspecialchars($request->title);
        $deskripsi = htmlspecialchars($request->deskripsi);
        $images = $request->file('images');
        $getData = KonfigurasiMobileModel::where('id', $id)->first();

        if (is_null($images)) {
            $update = KonfigurasiMobileModel::find($id)->update([
                'title' => $title,
                'deskripsi' => $deskripsi,
            ]);
        } else {
            $pathDelete = "storage/" . $getData->images;
            unlink($pathDelete);

            $update = KonfigurasiMobileModel::find($id)->update([
                'title' => $title,
                'deskripsi' => $deskripsi,
                'images' => $images->store('img', 'public')
            ]);
        }

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = KonfigurasiMobileModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
        }
    }
}
