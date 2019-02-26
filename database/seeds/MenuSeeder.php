<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_menu')->insert([
            [
                'title' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'icon icon-dashboard',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Menu',
                'url' => 'kelolamenu',
                'icon' => 'icon icon-server',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Level Penguna',
                'url' => 'userlevel',
                'icon' => 'icon icon-users',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Penguna',
                'url' => 'user',
                'icon' => 'icon icon-user',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Pemesanan Tiket',
                'url' => 'pemesanan',
                'icon' => 'icon icon-shopping-cart',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Konfirmasi Pembayaran',
                'url' => 'konfirmasi',
                'icon' => 'icon icon-money',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Konfigurasi Website',
                'url' => 'konfigurasi',
                'icon' => 'icon icon-laptop',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Konfigurasi Mobile',
                'url' => 'mobile',
                'icon' => 'icon icon-mobile',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ]
        ]);
    }
}
