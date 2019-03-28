<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\MenuModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{

    public function index()
    {
        $menu = MenuModel::select('id', 'title')->get();
        $title = "Halaman Kelola Menu";
        $deskripsi = "Halaman kelola menu digunakan untuk mengelola data menu yang digunakan";
        return view('menu.menuView', compact('title', 'deskripsi', 'menu'));
    }

    public function datatable()
    {
        $menu = MenuModel::select("id", "title", "url", "icon", "is_main_menu", "is_aktif")->get();
        return DataTables::of($menu)->addIndexColumn()->make(true);
    }

    public function store(MenuRequest $request)
    {
        $title = htmlspecialchars($request->title);
        $url = htmlspecialchars($request->url);
        $icon = htmlspecialchars($request->icon);
        $menu = $request->is_main_menu;
        $status = $request->is_aktif;

        $insert = MenuModel::create([
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_main_menu' => $menu,
            'is_aktif' => $status
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

        $getData = MenuModel::where('id', $id)->first();

        if ($getData) {
            return response()->json(['status' => 200, 'list' => $getData]);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(MenuRequest $request)
    {
        $title = htmlspecialchars($request->title);
        $url = htmlspecialchars($request->url);
        $icon = htmlspecialchars($request->icon);
        $menu = $request->is_main_menu;
        $status = $request->is_aktif;
        $id = $request->id;

        $update = MenuModel::find($id)->update([
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_main_menu' => $menu,
            'is_aktif' => $status
        ]);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = MenuModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal dihapus']);
        }
    }
}
