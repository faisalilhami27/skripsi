<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konfigurasi_web')->insert([
            [
                'kode_konfig' => "ALAMAT_PERUSAHAAN",
                'nilai_konfig' => 'Kp. Rawasari RT/RW 02/03 Kecamatan Sukanagara Desa Sukanagara Kabupaten Cianjur, Jawa Barat, 42364.'
            ],
            [
                'kode_konfig' => "EMAIL",
                'nilai_konfig' => 'failda.waterpark06@gmail.com'
            ],
            [
                'kode_konfig' => "HARGA_TIKET",
                'nilai_konfig' => '13000'
            ],
            [
                'kode_konfig' => "LOGO_PERUSAHAAN",
                'nilai_konfig' => 'logo2.png'
            ],
            [
                'kode_konfig' => "NAMA_PERUSAHAAN",
                'nilai_konfig' => 'Failda Waterpark'
            ],
            [
                'kode_konfig' => "NO_TELEPON",
                'nilai_konfig' => '085624420395'
            ],
            [
                'kode_konfig' => "PEMILIK",
                'nilai_konfig' => 'Lili Kusnadi, S.IP'
            ],
            [
                'kode_konfig' => "RESET_PASSWORD",
                'nilai_konfig' => 'failda2006'
            ],
            [
                'kode_konfig' => "VERSION",
                'nilai_konfig' => '1.0'
            ],
            [
                'kode_konfig' => "BANK",
                'nilai_konfig' => 'BANK BRI'
            ],
            [
                'kode_konfig' => "NOREK",
                'nilai_konfig' => '223101000405534'
            ],
            [
                'kode_konfig' => "PEMILIK_REKENING",
                'nilai_konfig' => 'Failda Waterpark'
            ]
        ]);
    }
}
