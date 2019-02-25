<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonfirmasiPembayaranRequest;
use App\Models\CustomerModel;
use App\Models\KonfirmasiPembayaranModel;
use App\Models\StatusPembayaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class KonfirmasiPembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
        $idUserLevel = Session::get('id_user_level');
        $idMenu = getIdMenu();
        $akses = checkAccess($idUserLevel, $idMenu);
        $status = StatusPembayaranModel::all();
        $title = "Halaman Konfirmasi Pembayaran";
        $deskripsi = "Halaman konfirmasi pembayaran digunakan untuk mengonfirmasi pemesanan dari customer";
        return view('pembayaran.konfirmasiView', compact('title', 'deskripsi', 'status', 'akses'));
    }

    public function datatable()
    {
        $data = KonfirmasiPembayaranModel::with(['pemesananTiket.customer'])
            ->whereHas('pemesananTiket', function ($query){
                $query->where('id_jenis', 2);
                $query->where('id_customer', '!=' , 0);
            })->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = KonfirmasiPembayaranModel::findOrFail($id);

        if ($data) {
            return response()->json(['status' => 200, 'list' => $data]);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(KonfirmasiPembayaranRequest $request)
    {
        $data = $request->all();
        $id = $request['id'];

        $update = KonfirmasiPembayaranModel::find($id)->update($data);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = KonfirmasiPembayaranModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal dihapus']);
        }
    }
}
