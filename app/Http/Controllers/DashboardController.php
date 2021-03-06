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

        $title = "Halaman Dashboard";
        $deskripsi = "Halaman Dashboard digunakan untuk melihat statistik";
        return view('dashboard', compact('title', 'deskripsi', 'hari', 'hari2', 'totalUang'));
    }

    public function chartForDataByDay()
    {
        $data = PemesananModel::select(DB::raw('DAY(tgl_pemesanan) AS tanggal, SUM(jumlah_tiket) AS jumlah'))
            ->whereRaw('MONTH(tgl_pemesanan) = MONTH(CURDATE())')
            ->groupBy(DB::raw('tgl_pemesanan'))
            ->get();
        return response()->json($data);
    }

    public function chartForDataByMonth()
    {
        $data = PemesananModel::select(DB::raw('MONTHNAME(tgl_pemesanan) AS bulan, SUM(jumlah_tiket) AS jumlah'))
            ->whereRaw('YEAR(tgl_pemesanan) = YEAR(CURDATE())')
            ->groupBy(DB::raw('MONTH(tgl_pemesanan)'))
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
