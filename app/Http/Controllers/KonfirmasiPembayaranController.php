<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonfirmasiPembayaranRequest;
use App\Models\CustomerModel;
use App\Models\KonfigurasiModel;
use App\Models\KonfirmasiPembayaranModel;
use App\Models\PemesananModel;
use App\Models\StatusPembayaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\PHPMailer;
use Yajra\DataTables\DataTables;
use PHPMailer\PHPMailer\Exception;

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
        $data = KonfirmasiPembayaranModel::with(['pemesananTiket.customer', 'statusPembayaran'])
            ->whereHas('pemesananTiket', function ($query) {
                $query->where('id_jenis', 2);
                $query->where('id_customer', '!=', 0);
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

    public function getBuktiPembayaran(Request $request)
    {
        $id = $request->id;
        $data = KonfirmasiPembayaranModel::with('pemesananTiket')
            ->where('id', $id)
            ->first();

        if ($data) {
            return response()->json(['status' => 200, 'list' => $data]);
        } else {
            return response()->json(['status' => 449, 'msg' => 'Data tidak ditemukan']);
        }
    }

    public function update(KonfirmasiPembayaranRequest $request)
    {
        $konfigurasi = KonfigurasiModel::all();
        $status = $request->id_status;
        $pengubah = Session::get('id_users');
        $id = $request->id;
        $getKode = KonfirmasiPembayaranModel::findOrFail($id);
        $kode = $getKode->kode_pemesanan;
        $data = PemesananModel::with('customer')
            ->where('kode_pemesanan', $kode)
            ->first();
        $email = $data->customer->email;
        $getTotal = $konfigurasi[2]->nilai_konfig * $data->jumlah_tiket;
        $total = "Rp. " . number_format($getTotal, 0, ".", ".");

        if ($status == 1) {
            return response()->json(['status' => 449, 'msg' => 'Silahkan ubah status jika data sudah lengkap']);
        }

        $update = KonfirmasiPembayaranModel::find($id)->update([
            'id_status' => $status,
            'id_karyawan' => $pengubah
        ]);

        $mail = new PHPMailer(true);
        if ($status == 3) {
            if ($update) {
                try {
                    $body = view('bodyEmailFailed', compact('data', 'konfigurasi', 'total', 'getKode'))->render();
                    $mail->IsSMTP(true);
                    $mail->IsHTML(true);
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = "failda.waterpark06@gmail.com";
                    $mail->Password = "barca1899";
                    $mail->SetFrom($mail->Username, "Kesalahan Verifikasi Pembayaran");
                    $mail->Subject = "Kesalahan Verifikasi Pembayaran";
                    $mail->AddAddress($email);
                    $mail->Body = $body;
                    if ($mail->send()) {
                        return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
            } else {
                return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
            }
        } else {
            if ($update) {
                try {
                    $body = view('bodyEmail', compact('data', 'konfigurasi', 'total', 'getKode'))->render();
                    $mail->IsSMTP(true);
                    $mail->IsHTML(true);
                    $mail->SMTPSecure = "ssl";
                    $mail->Host = "smtp.gmail.com";
                    $mail->Port = 465;
                    $mail->SMTPAuth = true;
                    $mail->Username = "failda.waterpark06@gmail.com";
                    $mail->Password = "barca1899";
                    $mail->SetFrom($mail->Username, "Verifikasi Pembayaran");
                    $mail->Subject = "Verifikasi Pembayaran";
                    $mail->AddAddress($email);
                    $mail->Body = $body;
                    if ($mail->send()) {
                        return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah']);
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
            } else {
                return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
            }
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
