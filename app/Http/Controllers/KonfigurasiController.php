<?php

namespace App\Http\Controllers;

use App\Http\Requests\KonfigurasiRequest;
use App\Models\KonfigurasiModel;

class KonfigurasiController extends Controller
{

    public function index()
    {
        $konfig = KonfigurasiModel::all();
        $title = 'Halaman Konfigurasi Website';
        $deskripsi = 'Halaman konfigurasi website digunakan untuk mengelola konfigurasi aplikasi';
        return view('konfigurasi.konfigurasi', compact('konfig', 'title', 'deskripsi'));
    }

    public function update(KonfigurasiRequest $request)
    {
        $namaPerusahaan = htmlspecialchars($request->nama_perusahaan);
        $namaPemilik = htmlspecialchars($request->nama_pemilik);
        $email = htmlspecialchars($request->email);
        $noHP = htmlspecialchars($request->no_hp);
        $password = htmlspecialchars($request->password);
        $alamat = htmlspecialchars($request->alamat);
        $versi = htmlspecialchars($request->versi);
        $harga = htmlspecialchars($request->harga);
        $bank = htmlspecialchars($request->bank);
        $norek = htmlspecialchars($request->norek);
        $file = $request->file('gambar');
        $konfig = KonfigurasiModel::all();

        $kode = "";
        $data = "";
        if ($file == "") {
            if ($namaPerusahaan != $konfig[4]->nilai_konfig) {
                $data = ['nilai_konfig' => $namaPerusahaan];
                $kode = "NAMA_PERUSAHAAN";
            } else if ($namaPemilik != $konfig[6]->nilai_konfig) {
                $data = ['nilai_konfig' => $namaPemilik];
                $kode = "PEMILIK";
            } else if ($email != $konfig[1]->nilai_konfig) {
                $data = ['nilai_konfig' => $email];
                $kode = "EMAIL";
            } else if ($noHP != $konfig[5]->nilai_konfig) {
                $data = ['nilai_konfig' => $noHP];
                $kode = "NO_TELEPON";
            } else if ($password != $konfig[7]->nilai_konfig) {
                $data = ['nilai_konfig' => $password];
                $kode = "RESET_PASSWORD";
            } else if ($alamat != $konfig[0]->nilai_konfig) {
                $data = ['nilai_konfig' => $alamat];
                $kode = "ALAMAT_PERUSAHAAN";
            } else if ($versi != $konfig[8]->nilai_konfig) {
                $data = ['nilai_konfig' => $versi];
                $kode = "VERSION";
            } else if ($harga != $konfig[2]->nilai_konfig) {
                $data = ['nilai_konfig' => $harga];
                $kode = "HARGA_TIKET";
            } else if ($bank != $konfig[9]->nilai_konfig) {
                $data = ['nilai_konfig' => $bank];
                $kode = "BANK";
            } else if ($norek != $konfig[10]->nilai_konfig) {
                $data = ['nilai_konfig' => $norek];
                $kode = "NOREK";
            }

            if ($kode == '' && $data == '') {
                return response()->json(['status' => 449]);
            } else {
                $update = KonfigurasiModel::where('kode_konfig', $kode)->update($data);
            }

            if ($update) {
                return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah otomatis']);
            } else {
                return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
            }
        } else {
            $kode = "LOGO_PERUSAHAAN";

            $data = [
              'nilai_konfig' => $file->store('img', 'public')
            ];

            if ($file->getSize() > 1000000) {
                return response()->json(["status" => 449, "msg" => "Maksimal file adalah 1 MB"]);
            } else {
                $update = KonfigurasiModel::where('kode_konfig', $kode)->update($data);

                if ($update) {
                    return response()->json(['status' => 200, 'msg' => 'Data berhasil diubah otomatis']);
                } else {
                    return response()->json(['status' => 449, 'msg' => 'Data gagal diubah']);
                }
            }
        }
    }
}
