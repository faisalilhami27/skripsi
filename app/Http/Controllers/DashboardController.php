<?php

namespace App\Http\Controllers;

use App\Models\KonfirmasiPembayaranModel;
use App\Models\PemesananModel;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
        $date = date('Y-m-d');
        $hari = PemesananModel::select(DB::raw('count(kode_pemesanan) as total'))
            ->where('tgl_pemesanan', '=', $date)
            ->first()->total;
        $bulan = PemesananModel::select(DB::raw('count(kode_pemesanan) as total'))
            ->whereRaw('MONTH(tgl_pemesanan) = MONTH(CURDATE())')
            ->first()->total;
        $konfirmasi = KonfirmasiPembayaranModel::with(['pemesananTiket'])
            ->select(DB::raw('count(kode_pemesanan) as total'))
            ->where('id_status', 1)
            ->where('bukti_pembayaran', '!=', null)
            ->first()->total;
        $totalUang = PemesananModel::select(DB::raw('sum(total_uang_masuk) as total'))
            ->where('tgl_pemesanan', '=', $date)
            ->first()->total;

        $title = "Halaman Dashboard";
        $deskripsi = "Halaman Dashboard digunakan untuk melihat statistik";
        return view('dashboard', compact('title', 'deskripsi', 'hari', 'bulan', 'konfirmasi', 'totalUang'));
    }

    public function chartForDataByDay()
    {
        $data = PemesananModel::select(DB::raw('DAY(tgl_pemesanan) AS tanggal, COUNT(*) AS jumlah'))
            ->whereRaw('MONTH(tgl_pemesanan) = MONTH(CURDATE())')
            ->groupBy(DB::raw('YEARWEEK(tgl_pemesanan)'))
            ->get();
        return response()->json($data);
    }

    public function chartForDataByMonth()
    {
        $data = PemesananModel::select(DB::raw('MONTHNAME(tgl_pemesanan) AS bulan, COUNT(*) AS jumlah'))
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
            $query->select('kode_pemesanan', 'tgl_pemesanan', 'tgl_masuk', 'jumlah_tiket', 'id_customer');
        }, 'pemesananTiket.customer' => function ($query) {
            $query->select('id', 'nama', 'images');
        }])
            ->where('id_status', 1)
            ->where('bukti_pembayaran', '!=', null)
            ->get();
        return response()->json(['unseen_notification' => $countNotif, 'notification' => $message]);
    }
}
