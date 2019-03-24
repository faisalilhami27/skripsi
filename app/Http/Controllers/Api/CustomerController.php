<?php

namespace App\Http\Controllers\api;

use App\Models\CustomerModel;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function show(Request $request)
    {
        $id = $request->id;

        $customer = CustomerModel::findOrFail($id);
        $data[] = $customer;
        if ($customer) {
            return response()->json(['result' => $data, 'status' => 200]);
        } else {
            return response()->json(['msg' => "Data tidak ditemukan", 'status' => 500]);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $nama = $request->nama;
        $noHp = $request->no_hp;
        $file = $request->file('images');

        $checkData = CustomerModel::findOrFail($id);
        $size = 1000000;
        $update = "";
        if ($checkData->no_hp == $noHp) {
            if (!is_null($file)) {
                if ($file->getSize() > $size) {
                    return response()->json(["status" => 500, "msg" => "Maximum file 1 MB"]);
                }
                $images = $checkData->images;
                if (is_null($images)) {
                    $data = [
                        'nama' => $nama,
                        'no_hp' => $noHp,
                        'images' => url('storage') . "/" . $file->store('img', 'public')
                    ];

                    $update = CustomerModel::where('id', $id)->update($data);
                } else {
                    $pathDelete = str_replace(url('') . '/', '', $images);
                    unlink($pathDelete);
                    $data = [
                        'nama' => $nama,
                        'no_hp' => $noHp,
                        'images' => url('storage') . "/" . $file->store('img', 'public')
                    ];

                    $update = CustomerModel::where('id', $id)->update($data);
                }
            } else {
                $data = [
                    'nama' => $nama,
                    'no_hp' => $noHp
                ];

                $update = CustomerModel::where('id', $id)->update($data);
            }
        } else {
            $checkNoHp = CustomerModel::where('no_hp', $noHp)->count();

            if ($checkNoHp == 1) {
                return response()->json(["status" => 500, "result" => $checkNoHp, "msg" => "No Handphone sudah terdaftar"]);
            } else {
                $data = [
                    'nama' => $nama,
                    'no_hp' => $noHp
                ];

                $update = CustomerModel::where('id', $id)->update($data);
            }
        }

        if ($update) {
            return response()->json(["status" => 200, "user" => $data, "msg" => "Data berhasil diubah"]);
        } else {
            return response()->json(['status' => 500, 'msg' => 'Data gagal diubah']);
        }
    }
}
