<?php

namespace App\Http\Controllers\api;

use App\Models\KonfirmasiPembayaranModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;

class PembayaranController extends Controller
{
    public function update(Request $request)
    {
        $kode = $request->kode_pemesanan;
        $file = $request->file('bukti');
        $size = 1000000;

        if (is_null($file)) {
            return response()->json(['status' => 500, 'msg' => 'Silahkan pilih gambar']);
        } else {
            if ($file->getSize() > $size) {
                return response()->json(['status' => 500, 'msg' => 'Maximum file 1 MB']);
            }

            $data = [
                'bukti_pembayaran' => url('storage') . '/' . $file->store('pembayaran/'. $kode .'', 'public')
            ];

            DB::beginTransaction();
            try {
                $update = KonfirmasiPembayaranModel::where('kode_pemesanan', $kode)->update($data);

                if ($update) {
                    $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                    );
                    $pusher = new Pusher(
                        'ca529096e60dc5ab5a37',
                        '06eb93af4bceb9c2da38',
                        '717606',
                        $options
                    );

                    $data1['message'] = 'hello world';
                    $pusher->trigger('my-channel1', 'my-event1', $data1);
                    DB::commit();
                    return response()->json(["status" => 200, "user" => $data, "msg" => "Bukti pembayaran berhasil diupload"]);
                } else {
                    return response()->json(["status" => 500, "msg" => "Data gagal diupload"]);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['status' => 500, 'msg' => 'Server sedang sibuk silahkan ulangi beberapa saat lagi']);
            }
        }
    }
}
