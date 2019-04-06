<?php

namespace App\Http\Controllers\api;

use App\Models\KonfigurasiMobileModel;
use App\Http\Controllers\Controller;
use App\Models\KonfigurasiModel;

class KonfigurasiMobileController extends Controller
{
    public function index()
    {
        $kontenMobile = KonfigurasiMobileModel::all();
        $konfigurasiWeb = KonfigurasiModel::all();

        $data = [
          'harga' => (integer) $konfigurasiWeb[2]->nilai_konfig,
          'bank' => $konfigurasiWeb[9]->nilai_konfig,
          'norek' => $konfigurasiWeb[10]->nilai_konfig,
        ];

        if ($kontenMobile) {
            return response()->json(['result' => $kontenMobile, 'konfigurasi' => $data, 'status' => 200]);
        } else {
            return response()->json(['msg' => "Data tidak ditemukan", 'status' => 500]);
        }
    }
}
