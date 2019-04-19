<?php

namespace App\Http\Controllers;

use App\Http\Requests\PemesananRequest;
use App\Models\KonfigurasiModel;
use App\Models\KonfirmasiPembayaranModel;
use App\Models\PemesananModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\DataTables\DataTables;

class PemesananController extends Controller
{
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

    public function datatable(Request $request)
    {
        $data = PemesananModel::with('karyawan.karyawan', 'jenisPemesanan')
            ->whereHas('pembayaran', function ($query){
                $query->where('bukti_pembayaran', '!=', Null);
                $query->orWhere('id_status', 2);
            });

        if (htmlspecialchars($request->has('status')) && htmlspecialchars($request->query('status')) != "") {
            $data->where('status_penggunaan', htmlspecialchars($request->query('status')));
        } else {
            $data->where('tgl_pemesanan', Carbon::now()->format('Y-m-d'));
        }

        $datatable = $data->orderBy('kode_pemesanan', 'DESC')->get();
        return DataTables::of($datatable)->addIndexColumn()->make(true);
    }

    public function store(PemesananRequest $request)
    {
        $idJenis = 1;
        $tiket = htmlspecialchars($request->tiket);
        $jumlahUang = htmlspecialchars($request->total);
        $uangPembayaran = htmlspecialchars($request->pembayaran);
        $namaKasir = Session::get('id_users');

        if ($uangPembayaran < $jumlahUang) {
            return response()->json(['status' => 500, 'msg' => 'Uang pembayaran tidak boleh kurang dari harga']);
        } else {
            $kode = setKode();
            $generate = "TRS-" . Carbon::now()->format('m-d') . "-" . $kode;
            $qrCode = $generate . ".png";
            $path = "storage/qr_code/" . $qrCode;
            Storage::makeDirectory('qr_code');
            QrCode::format('png')
                ->size(500)
                ->errorCorrection('H')
                ->generate($generate, $path);

            $insert = PemesananModel::create([
                'kode_pemesanan' => "TRS-" . Carbon::now()->format('m-d') . "-" . $kode,
                'tgl_pemesanan' => date('Y-m-d'),
                'id_jenis' => $idJenis,
                'jumlah_tiket' => $tiket,
                'total_uang_masuk' => $jumlahUang,
                'uang_pembayaran' => $uangPembayaran,
                'id_karyawan' => $namaKasir,
                'status_penggunaan' => 0,
                'id_customer' => 0,
                'qr_code' => $qrCode
            ]);

            KonfirmasiPembayaranModel::create([
                'kode_pemesanan' => $insert->kode_pemesanan,
                'bukti_pembayaran' => null,
                'id_status' => 2
            ]);
        }

        if ($insert) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil ditambahkan']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal ditambahkan']);
        }
    }

    public function show($id)
    {
        $data = PemesananModel::with(['karyawan.karyawan', 'customer', 'jenisPemesanan', 'pembayaran'])
            ->where('id', $id)
            ->first();
        $title = "Halaman Detail Pemesanan";
        $deskripsi = "Halaman detail pemesanan digunakan untuk melihat detail pemesanan dari customer";
        $tanggalPemesanan = strtotime($data->tgl_pemesanan);
        $tanggalPemesanan = strtotime("+7 days", $tanggalPemesanan);
        $nextDay = date("Y-m-d", $tanggalPemesanan);
        return view('pemesanan.detailPemesanan', compact('data', 'title', 'deskripsi', 'nextDay'));
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = PemesananModel::findOrFail($id);

        if ($data) {
            return response()->json(['status' => 200, 'list' => $data]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'tiket' => 'required|numeric',
            'total' => 'required|numeric'
        ]);

        $tiket = $request->tiket;
        $total = $request->total;
        $pengubah = Session::get('id_users');
        $id = $request->id;

        $update = PemesananModel::find($id)->update([
            'jumlah_tiket' => $tiket,
            'total_uang_masuk' => $total,
            'id_pengubah' => $pengubah
        ]);

        if ($update) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        $delete = PemesananModel::find($id)->delete();

        if ($delete) {
            return response()->json(['status' => 200, 'msg' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal dihapus']);
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
