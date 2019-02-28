<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChooseRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trs_user_karyawan')->insert([
            [
                'id_karyawan' => 1,
                'id_user_level' => 1
            ]
        ]);
    }
}
