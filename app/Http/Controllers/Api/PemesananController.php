<?php

namespace App\Http\Controllers\api;

use App\Models\KonfigurasiModel;
use App\Models\KonfirmasiPembayaranModel;
use App\Models\PemesananModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use LaravelQRCode\Facades\QRCode;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Pusher\Pusher;

class PemesananController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->id;

        $pemesanan = PemesananModel::with(['jenisPemesanan', 'pembayaran', 'customer'])
            ->where('id', $id)
            ->first();

        $data = [
            [
                "id" => (String)$pemesanan->id,
                "kode_pemesanan" => $pemesanan->kode_pemesanan,
                "tgl_pemesanan" => $pemesanan->tgl_pemesanan,
                "id_karyawan" => $pemesanan->id_karyawan,
                "jumlah_tiket" => (String)$pemesanan->jumlah_tiket,
                "total_uang_masuk" => (String)$pemesanan->total_uang_masuk,
                "uang_pembayaran" => (String)$pemesanan->uang_pembayaran,
                "status_penggunaan" => (String)$pemesanan->status_penggunaan,
                "id_jenis" => (String)$pemesanan->id_jenis,
                "id_customer" => (String)$pemesanan->id_customer,
                "qr_code" => $pemesanan->qr_code,
                "created_at" => Carbon::parse($pemesanan->created_at)->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::parse($pemesanan->updated_at)->format('Y-m-d H:i:s'),
                "deleted_at" => $pemesanan->deleted_at,
                "nama_jenis" => $pemesanan->jenisPemesanan->nama_jenis,
                "id_status" => (String)$pemesanan->pembayaran->id_status,
                "batas_pembayaran" => $pemesanan->pembayaran->batas_pembayaran,
                "bukti_pembayaran" => $pemesanan->pembayaran->bukti_pembayaran
            ]
        ];

        if ($data) {
            return response()->json(['result' => $data, 'status' => 200]);
        } else {
            return response()->json(['msg' => "Data tidak ditemukan", 'status' => 500]);
        }
    }

    public function getPemesananByIdCustomer(Request $request)
    {
        $idCustomer = $request->id_customer;
        $pemesanan = PemesananModel::with(['jenisPemesanan', 'pembayaran', 'customer'])
            ->where('id_customer', $idCustomer)
            ->orderBy('id', 'desc')
            ->get();

        $data = [];
        foreach ($pemesanan as $p) {
            $data[] = [
                "id" => (String)$p->id,
                "kode_pemesanan" => $p->kode_pemesanan,
                "tgl_pemesanan" => $p->tgl_pemesanan,
                "id_karyawan" => $p->id_karyawan,
                "jumlah_tiket" => (String)$p->jumlah_tiket,
                "total_uang_masuk" => (String)$p->total_uang_masuk,
                "uang_pembayaran" => (String)$p->uang_pembayaran,
                "status_penggunaan" => (String)$p->status_penggunaan,
                "id_jenis" => (String)$p->id_jenis,
                "id_customer" => (String)$p->id_customer,
                "qr_code" => $p->qr_code,
                "created_at" => Carbon::parse($p->created_at)->format('Y-m-d H:i:s'),
                "updated_at" => Carbon::parse($p->updated_at)->format('Y-m-d H:i:s'),
                "deleted_at" => $p->deleted_at,
                "nama_jenis" => $p->jenisPemesanan->nama_jenis,
                "id_status" => (String)$p->pembayaran->id_status,
                "batas_pembayaran" => $p->pembayaran->batas_pembayaran,
                "bukti_pembayaran" => $p->pembayaran->bukti_pembayaran
            ];
        }

        if ($data) {
            return response()->json(['result' => $data, 'status' => 200]);
        } else {
            return response()->json(['msg' => "Data tidak ditemukan", 'status' => 500]);
        }
    }

    public function store(Request $request)
    {
        $tiket = htmlspecialchars($request->jumlah_tiket);
        $jumlahUang = htmlspecialchars($request->jumlah_uang);
        $uangPembayaran = str_replace(".", "", $jumlahUang);
        $customer = $request->id_customer;
        $idJenis = 2;
        $date = Carbon::now()->format('Y-m-d H:i:s');

        $kode = setKode();
        $generate = "TRS-" . Carbon::now()->format('m-d') . "-" . $kode;
        $qrCode = $generate . ".png";
        $path = "storage/qr_code/" . $qrCode;
        Storage::makeDirectory('qr_code');
        QRCode::text($generate)
            ->setErrorCorrectionLevel("H")
            ->setSize(10)
            ->setOutFile($path)
            ->png();

        $insert = PemesananModel::create([
            'kode_pemesanan' => "TRS-" . Carbon::now()->format('m-d') . "-" . $kode,
            'tgl_pemesanan' => Carbon::now()->format('Y-m-d'),
            'id_jenis' => $idJenis,
            'jumlah_tiket' => $tiket,
            'total_uang_masuk' => $uangPembayaran,
            'uang_pembayaran' => $uangPembayaran,
            'status_penggunaan' => 0,
            'id_customer' => $customer,
            'qr_code' => $qrCode
        ]);

        KonfirmasiPembayaranModel::create([
            'kode_pemesanan' => "TRS-" . Carbon::now()->format('m-d') . "-" . $kode,
            'id_status' => 1,
            'batas_pembayaran' => Carbon::createFromFormat('Y-m-d H:i:s', $date)->addDay(1)
        ]);

        $pemesanan = PemesananModel::with(['customer', 'jenisPemesanan'])
            ->where('id', $insert->id)
            ->first();
        $getKonfigurasi = KonfigurasiModel::all();
        $email = $pemesanan->customer->email;
        $getTotal = $getKonfigurasi[2]->nilai_konfig * $pemesanan->jumlah_tiket;
        $totalHarga = "Rp. " . number_format($getTotal, 0, ".", ".");

        $data = $pemesanan;
        $konfigurasi = $getKonfigurasi;
        $total = $totalHarga;
        $getPemesanan = PemesananModel::with(['pembayaran'])
            ->where('id', $insert->id)
            ->first();
        $batas = $getPemesanan->pembayaran->batas_pembayaran;

        $body = view('bodyEmailPemesanan', compact('data', 'konfigurasi', 'total', 'batas'))->render();
        $mail = new PHPMailer(true);
        if ($insert) {
            try {
                $mail->IsSMTP(true);
                $mail->IsHTML(true);
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = "failda.waterpark06@gmail.com";
                $mail->Password = "barca1899";
                $mail->SetFrom($mail->Username, "Pemesanan Tiket");
                $mail->Subject = "Pemesanan Tiket";
                $mail->AddAddress($email);
                $mail->Body = $body;
                if ($mail->send()) {
                    return response()->json(["status" => 200, "id_pemesanan" => $insert->id, "msg" => "Pemesanan berhasil"]);
                }
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        } else {
            return response()->json(['status' => 500, 'msg' => 'Pemesanan gagal']);
        }
    }

    public function verifyDataByQRCode(Request $request)
    {
        $kode = $request->kode_pemesanan;
        $getData = PemesananModel::with(['pembayaran'])
            ->where('kode_pemesanan', $kode)
            ->first();

        try {
            $today = date('Y-m-d');
            $tanggalPemesanan = strtotime($getData->tgl_pemesanan);
            $tanggalPemesanan = strtotime("+7 days", $tanggalPemesanan);
            $nextDay = date("Y-m-d", $tanggalPemesanan);
            $dateToday = date(strtotime($today));
            $dateNextDay = date(strtotime($nextDay));

            if ($dateToday > $dateNextDay) {
                return response()->json(['result' => '', 'status' => 500, 'msg' => 'Tidak diperbolehkan masuk karena melebihi batas tanggal yang sudah ditentukan yaitu tanggal ' . $nextDay . '']);
            } else if ($getData->pembayaran->id_status == 1) {
                return response()->json(['result' => '', 'status' => 500, 'msg' => 'Anda belum melakukan pembayaran']);
            } elseif ($getData->status_penggunaan == 1) {
                return response()->json(['result' => 'Data Kosong', 'status' => 500, 'msg' => 'QR Code sudah digunakan']);
            } else {
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

                $data['message'] = 'hello world';
                $pusher->trigger('my-channel', 'my-event', $data);
                $pemesanan = PemesananModel::where('kode_pemesanan', $kode)->update([
                    'status_penggunaan' => 1
                ]);
                return response()->json(['result' => $pemesanan, 'status' => 200, 'msg' => 'Data sudah diverifikasi', 'jumlah' => $getData->jumlah_tiket, 'total' => $getData->total_uang_masuk]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Data tidak ditemukan']);
        }
    }
}
