<?php

namespace App\Http\Controllers;

use App\Models\KonfirmasiPembayaranModel;
use App\Models\PemesananModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $date = Carbon::now()->format("Y-m-d");
        $hari = PemesananModel::select(DB::raw('sum(jumlah_tiket) as total'))
            ->where('tgl_pemesanan', '=', $date)
            ->where('id_jenis', '=', 1)
            ->first()->total;
        $hari2 = PemesananModel::select(DB::raw('sum(jumlah_tiket) as total'))
            ->whereHas('pembayaran', function ($query) {
                $query->where('id_status', 2);
            })
            ->where('tgl_pemesanan', '=', $date)
            ->where('id_jenis', '=', 2)
            ->first()->total;
        $totalUang = PemesananModel::select(DB::raw('sum(total_uang_masuk) as total'))
            ->where('tgl_pemesanan', '=', $date)
            ->where('id_jenis', '=', 1)
            ->first()->total;

        $client = new \GuzzleHttp\Client();
        $token = [
            'Authorization' => 'Bearer ' . env('TOKEN_MOOTA')
        ];
        $request = $client->get('https://app.moota.co/api/v1/bank/' . env('BANK_ID') . '/mutation', [
            'headers' => $token
        ]);
        $response = $request->getBody()->getContents();
        $decode = json_decode($response);
        if (!empty($decode->data[0])) {
            $saldoTerbaru = substr($decode->data[0]->balance, 0, -3);
        } else {
            $saldoTerbaru = 0;
        }
        $title = "Halaman Dashboard";
        $deskripsi = "Halaman Dashboard digunakan untuk melihat statistik";
        return view('dashboard', compact('title', 'deskripsi', 'hari', 'hari2', 'saldoTerbaru', 'totalUang'));
    }

    public function chartForDataByDay()
    {
        $data = PemesananModel::select(DB::raw('EXTRACT(DAY FROM tgl_pemesanan) AS tanggal, SUM(jumlah_tiket) AS jumlah'))
            ->whereRaw('EXTRACT(MONTH FROM tgl_pemesanan) = EXTRACT(MONTH FROM current_date)')
            ->groupBy(DB::raw('tgl_pemesanan'))
            ->get();
        return response()->json($data);
    }

    public function chartForDataByMonth()
    {
        $data = PemesananModel::select(DB::raw('to_char(tgl_pemesanan, \'Month\') AS bulan, SUM(jumlah_tiket) AS jumlah'))
            ->whereRaw('EXTRACT(YEAR FROM tgl_pemesanan) = EXTRACT(YEAR FROM current_date)')
            ->groupBy(DB::raw("to_char(tgl_pemesanan, 'mm'), to_char(tgl_pemesanan, 'Month')"))
            ->get();
        return response()->json($data);
    }

    public function getNotification()
    {
        $countNotif = KonfirmasiPembayaranModel::where('id_status', 1)
            ->where('bukti_pembayaran', '!=', null)
            ->count();
        $message = KonfirmasiPembayaranModel::with(['pemesananTiket' => function ($query) {
            $query->select('kode_pemesanan', 'tgl_pemesanan', 'jumlah_tiket', 'id_customer');
        }, 'pemesananTiket.customer' => function ($query) {
            $query->select('id', 'nama', 'images');
        }])
            ->where('id_status', 1)
            ->where('bukti_pembayaran', '!=', null)
            ->get();
        return response()->json(['unseen_notification' => $countNotif, 'notification' => $message]);
    }
}
