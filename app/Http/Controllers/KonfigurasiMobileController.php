<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonfigurasiMobileRequest;
use App\Models\KonfigurasiMobileModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KonfigurasiMobileController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
        $title = 'Halaman Konfigurasi Website';
        $deskripsi = 'Halaman konfigurasi website digunakan untuk mengelola konfigurasi aplikasi';
        return view('konfigurasimobile.konfigurasiMobileView', compact('title', 'deskripsi'));
    }

    public function datatable()
    {
        $data = KonfigurasiMobileModel::select("id", "title", "images")->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(KonfigurasiMobileRequest $request)
    {
        $title = $request->title;
        $images = $request->file('images');
        $insert  = KonfigurasiMobileModel::create([
            'title' => $title,
            'images' => $images->store('img', 'public')
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

        $getData = KonfigurasiMobileModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(KonfigurasiMobileRequest $request)
    {
        $id = $request->id;
        $title = $request->title;
        $images = $request->file('images');
        $getData = KonfigurasiMobileModel::where('id', $id)->first();

        if (is_null($images)) {
            $update = KonfigurasiMobileModel::findOrFile($id)->update([
                'title' => $title,
            ]);
        } else {
            $pathDelete = "storage/" . $getData->images;
            unlink($pathDelete);

            $update = KonfigurasiMobileModel::findOrFile($id)->update([
                'title' => $title,
                'images' => $images->store('img', 'public')
            ]);
        }

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = KonfigurasiMobileModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal dihapus']);
        }
    }
}
