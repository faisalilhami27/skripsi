<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_user_karyawan')->insert([
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
