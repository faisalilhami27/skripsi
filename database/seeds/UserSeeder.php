<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_karyawan')->insert([
            [
                'id_karyawan' => 1,
                'username' => 'faisal27',
                'password' => Hash::make('barca1899'),
                'images' => null,
                'status' => 'y'
            ]
        ]);
    }
}
