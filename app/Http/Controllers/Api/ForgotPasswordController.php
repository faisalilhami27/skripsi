<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerModel;
use App\Models\KonfigurasiModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $username = $request->username;
        $checkUsername = CustomerModel::where('username', $username)->first();
        $getKonfigurasi = KonfigurasiModel::all();

        if ($checkUsername) {
            $getEmail = $checkUsername->email;
            $email = $getEmail;
            $konfigurasi = $getKonfigurasi;
            $link = url('api/resetPassword') . "/" . encryptString($username);
            $body = view('bodyResetPassword', compact('email', 'konfigurasi', 'link'))->render();
            $mail = new PHPMailer;
            try {
                $mail->IsSMTP(true);
                $mail->IsHTML(true);
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;
                $mail->SMTPAuth = true;
                $mail->Username = "failda.waterpark06@gmail.com";
                $mail->Password = "barca1899";
                $mail->SetFrom($mail->Username, "Reset Password");
                $mail->Subject = "Reset Password";
                $mail->AddAddress($email);
                $mail->Body = $body;
                if ($mail->Send()) {
                    return response()->json(["status" => 200, "msg" => "Silahkan tunggu 5 - 10 menit untuk mendapatkan email reset password"]);
                } else {
                    echo $string = "Failed to sending message";
                    die;
                }
            } catch (Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        } else {
            return response()->json(["status" => 500, "msg" => "Username tidak terdaftar"]);
        }
    }

    public function resetPassword($username)
    {
        $encrypt = encryptString(decryptString($username));
        if ($username != $encrypt) {
            Session::flash('error', 'Anda telah merubah token');
            $data['username'] = "";
            return view('resetPassword', $data);
        } else {
            $data['username'] = decryptString($username);
            return view('resetPassword', $data);
        }
    }

    public function changePassword(Request $request)
    {
        $username = $request->username;
        $password = htmlspecialchars($request->password);

        $update = CustomerModel::where('username', $username)->update([
            'password' => Hash::make($password)
        ]);

        if ($update) {
            return response()->json(["status" => 200, "msg" => "Password berhasil direset"]);
        } else {
            return response()->json(["status" => 500, "msg" => "Password gagal direset"]);
        }
    }
}
