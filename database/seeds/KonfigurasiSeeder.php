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
        DB::table('mst_konfigurasi_web')->insert([
            [
                'kode_konfig' => "ALAMAT_PERUSAHAAN",
                'nilai_konfig' => 'Kp. Rawasari RT/RW 02/03 Kecamatan Sukanagara Desa Sukanagara Kabupaten Cianjur, Jawa Barat, 42364.'
            ],
            [
                'kode_konfig' => "EMAIL",
                'nilai_konfig' => 'failda.waterpark@gmail.com'
            ],
            [
                'kode_konfig' => "HARGRA_TIKET",
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
        ]);
    }
}
