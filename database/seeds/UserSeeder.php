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
                'nama' => 'Muhamad Faisal Ilhami Akbar',
                'username' => 'faisal27',
                'email' => 'faisal.ilhami1997@gmail.com',
                'password' => Hash::make('barca1899'),
                'images' => null,
                'id_user_level' => 1,
                'status' => 'y'
            ]
        ]);
    }
}
