<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerModel;
use App\Models\KonfigurasiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class RegisterCustomerController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:60',
            'username' => 'required|string|max:20',
            'email' => 'required|string|email|max:60',
            'password' => 'required|string|min:8|max:12',
            'no_hp' => 'required',
            'player_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'msg' => $validator->errors()->toArray()]);
        }

        $namaCustomer = htmlspecialchars($request->get('nama'));
        $username = htmlspecialchars($request->get('username'));
        $email = htmlspecialchars($request->get('email'));
        $password = htmlspecialchars($request->get('password'));
        $noHP = htmlspecialchars($request->get('no_hp'));
        $playerId = $request->get('player_id');
        $cekUsername = CustomerModel::where('username', $username)->count();
        $cekEmail = CustomerModel::where('email', $email)->count();
        $cekNoHP = CustomerModel::where('no_hp', $noHP)->count();

        if ($cekUsername == 1) {
            return response()->json(["status" => 500, "result" => $cekUsername, "msg" => "Username sudah digunakan"]);
        } else if ($cekEmail == 1) {
            return response()->json(["status" => 500, "result" => $cekEmail, "msg" => "Email sudah digunakan"]);
        } else if ($cekNoHP == 1) {
            return response()->json(["status" => 500, "result" => $cekNoHP, "msg" => "No Handphone sudah digunakan sudah digunakan"]);
        } else {
            $insert = CustomerModel::create([
                'nama' => $namaCustomer,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'no_hp' => $noHP,
                'status' => "n",
                'player_id' => $playerId,
            ]);

            $konfigurasi = KonfigurasiModel::all();
            $nama = $namaCustomer;
            $token = url('api/verifyAccount') . '/' . encryptString($insert->id);

            $mail = new PHPMailer;
            $body = view('bodyEmailVerification', compact('nama', 'konfigurasi', 'token'))->render();
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
                    $mail->SetFrom($mail->Username, "Email Verification");
                    $mail->Subject = "Email Verification";
                    $mail->AddAddress($email);
                    $mail->Body = $body;
                    if ($mail->Send()) {
                        return response()->json(["status" => 200, "result" => $insert, "msg" => "Registrasi berhasil, silahkan tunggu 5 - 10 menit untuk mendapatkan email verifikasi"]);
                    } else {
                        echo $string = "Failed to sending message";
                        die;
                    }
                } catch (Exception $e) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                }
            } else {
                return response()->json(["status" => 500, "msg" => "Registrasi gagal"]);
            }
        }
    }

    public function verify($key)
    {
        $update = CustomerModel::where('id', decryptString($key))->update([
            'status' => "y"
        ]);

        if ($update) {
            echo "Selamat akun anda sudah diaktifkan";
        } else {
            echo "Akun gagal diaktifkan";
        }
    }
}
