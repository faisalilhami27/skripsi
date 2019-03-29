<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class AuthenticationController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function login()
    {
        if (is_null($this->request->loginAs) || $this->request->loginAs == '') {
            return response()->json(['status' => 500, 'msg' => 'Tipe otorisasi tidak dikenal']);
        }

        $user = null;

        switch ($this->request->loginAs) {
            case 'api_customer':
                $loginAs = CustomerModel::where('username', $this->request->username)->first();
                if (!is_null($this->request->player_id) || $this->request->player_id != '') {
                    if ($this->request->player_id != $loginAs->player_id) {
                        CustomerModel::where('username', $this->request->username)->update([
                            'player_id' => $this->request->player_id
                        ]);
                    }
                } else {
                    return "";
                }
                $user = $loginAs;
                break;
            case 'api_karyawan':
                $loginAs = UserModel::with(['karyawan'])
                    ->where('username', $this->request->username)
                    ->first();
                $user = $loginAs;
                break;
        }

        if (is_null($user['username'])) {
            return response()->json(["status" => 500, "msg" => "Username anda tidak terdaftar"]);
        } else {
            if ($user['status'] == "y") {
                if ($user->count() > 0) {
                    if (Hash::check($this->request->password, $user['password'])) {
                        $token = encrypt($user->id);
                        $user->api_token = $token;
                        $user->save();
                        $data['id_token'] = $token;
                        return response()->json(["status" => 200, 'result' => $data, "msg" => "Login Success"]);
                    } else {
                        return response()->json(["status" => 500, "msg" => "Password yang anda inputkan salah"]);
                    }
                }
            } else {
                return response()->json(["status" => 500, "msg" => "Silahkan verifikasi email terlebih dahulu"]);
            }
        }
    }

    public function getAuthenticatedUser()
    {
        $user = Auth::user();
        $data = [
            'id' => (String) $user->id,
            'nama' => $user->nama,
            'email' => $user->email,
            'username' => $user->username,
            'password' => $user->password,
            'no_hp' => $user->no_hp,
            'images' => $user->images,
        ];
        return response()->json($data);
    }
}
