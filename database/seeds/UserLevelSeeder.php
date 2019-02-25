<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_user_level')->insert([
            [
                'nama_level' => 'Administrator'
            ],
            [
                'nama_level' => 'Kasir'
            ],
            [
                'nama_level' => 'Pimpinan'
            ],
        ]);
    }
}
