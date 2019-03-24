<?php

namespace App\Http\Controllers\api;

use App\Models\KonfigurasiMobileModel;
use App\Http\Controllers\Controller;

class KonfigurasiMobileController extends Controller
{
    public function index()
    {
        $konfigurasi = KonfigurasiMobileModel::all();

        if ($konfigurasi) {
            return response()->json(['result' => $konfigurasi, 'status' => 200]);
        } else {
            return response()->json(['msg' => "Data tidak ditemukan", 'status' => 500]);
        }
    }
}
