<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemesananRequest;
use App\Models\KonfigurasiModel;
use App\Models\PemesananModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use LaravelQRCode\Facades\QRCode;
use Yajra\DataTables\DataTables;

class PemesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkRole');
    }

    public function index()
    {
        $konfig = KonfigurasiModel::get();
        $idUserLevel = Session::get('id_user_level');
        $idMenu = getIdMenu();
        $akses = checkAccess($idUserLevel, $idMenu);
        $title = "Halaman Pemesanan";
        $deskripsi = "Halaman pemesanan digunakan untuk mengelola pemesanan dari customer";
        return view('pemesanan.pemesananView', compact('konfig', 'title', 'deskripsi', 'akses'));
    }

    public function datatable()
    {
        $data = PemesananModel::with('karyawan.karyawan', 'jenisPemesanan')->get();
        return DataTables::of($data)->addIndexColumn()->make(true);
    }

    public function store(PemesananRequest $request)
    {
        $idJenis = 1;
        $tiket = htmlspecialchars($request->tiket);
        $jumlahUang = htmlspecialchars($request->total);
        $uangPembayaran = htmlspecialchars($request->pembayaran);
        $namaKasir = Session::get('id_users');

        if ($uangPembayaran < $jumlahUang) {
            return response()->json(['status' => 449, 'msg' => 'Uang pembayaran tidak boleh kurang dari harga']);
        } else {
            $kode = setKode();
            $generate = "TRS-" . date('d') . "-" . $kode;
            $qrCode = $generate . ".png";
            $path = "storage/qr_code/" . $qrCode;
            Storage::makeDirectory('qr_code');
            QRCode::text($generate)
                ->setErrorCorrectionLevel("H")
                ->setSize(10)
                ->setOutFile($path)
                ->png();

            $insert = PemesananModel::create([
                'kode_pemesanan' => "TRS-" . date('d') . "-" . $kode,
                'tgl_pemesanan' => date('Y-m-d'),
                'tgl_masuk' => date('Y-m-d'),
                'id_jenis' => $idJenis,
                'jumlah_tiket' => $tiket,
                'total_uang_masuk' => $jumlahUang,
                'uang_pembayaran' => $uangPembayaran,
                'id_karyawan' => $namaKasir,
                'status_penggunaan' => 0,
                'status_notif' => "0",
                'id_customer' => 0,
                'qr_code' => $qrCode
            ]);
        }

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function printTicket($id)
    {
        $decode = KonfigurasiModel::all();
        $data = PemesananModel::where('kode_pemesanan', $id)->first();
        $jumlah = $data->total_uang_masuk;
        $kembalian = $data->uang_pembayaran - $jumlah;
        return view('cetak.cetak', compact('data', 'kembalian', 'jumlah', 'decode'));
    }
}
