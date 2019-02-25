<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_jenis_pemesanan')->insert([
            [
                'nama_jenis' => 'Langsung',
            ],
            [
                'nama_jenis' => 'Online lewat mobile',
            ]
        ]);
    }
}
