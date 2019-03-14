<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_status_pembayaran')->insert([
            [
                'nama_status' => 'Menunggu Pembayaran',
            ],
            [
                'nama_status' => 'Dibayar',
            ],
            [
                'nama_status' => 'Pembayaran Tidak Sesuai',
            ]
        ]);
    }
}
