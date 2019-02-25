<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_setting')->insert([
            [
                'nama_setting' => 'Tampil Menu',
                'value' => 'ya'
            ],
        ]);
    }
}
