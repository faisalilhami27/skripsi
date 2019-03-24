<?php

namespace App\Http\Controllers\api;

use App\Models\KonfirmasiPembayaranModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    public function update(Request $request)
    {
        $kode = $request->kode_pemesanan;
        $file = $request->file('bukti');
        $size = 1000000;
        if ($file->getSize() > $size) {
            return response()->json(['status' => 500, 'Maximum file 1 MB']);
        }

        $data = [
            'bukti_pembayaran' => url('storage') . '/' . $file->store('pembayaran/'. $kode .'', 'public')
        ];

        $update = KonfirmasiPembayaranModel::where('kode_pemesanan', $kode)->update($data);

        if ($update) {
            return response()->json(["status" => 200, "user" => $data, "msg" => "Bukti pembayaran berhasil diupload"]);
        } else {
            return response()->json(["status" => 500, "msg" => "Data gagal diupload"]);
        }
    }
}
