<?php

use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_karyawan')->insert([
            [
                'nama' => "Muhamad Faisal Ilhami Akbar",
                'email' => 'faisal.ilhami1997@gmail.com',
                'no_hp' => '085795118959'
            ],
        ]);
    }
}
