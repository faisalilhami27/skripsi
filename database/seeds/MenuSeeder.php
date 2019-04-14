<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            [
                'title' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'icon icon-dashboard',
                'order_num' => 1,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Menu',
                'url' => 'kelolamenu',
                'icon' => 'icon icon-server',
                'order_num' => 2,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Level Pengguna',
                'url' => 'userlevel',
                'icon' => 'icon icon-users',
                'order_num' => 3,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Karyawan',
                'url' => 'karyawan',
                'icon' => 'icon icon-user-plus',
                'order_num' => 4,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Pengguna',
                'url' => 'user',
                'icon' => 'icon icon-user',
                'order_num' => 5,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Customer',
                'url' => 'customer',
                'icon' => 'icon icon-user-plus',
                'order_num' => 6,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Pemesanan Tiket',
                'url' => 'pemesanan',
                'icon' => 'icon icon-shopping-cart',
                'order_num' => 7,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Konfirmasi Pembayaran',
                'url' => 'konfirmasi',
                'icon' => 'icon icon-money',
                'order_num' => 8,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Konfigurasi Website',
                'url' => 'konfigurasi',
                'icon' => 'icon icon-laptop',
                'order_num' => 9,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Konfigurasi Mobile',
                'url' => 'mobile',
                'icon' => 'icon icon-mobile',
                'order_num' => 10,
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
        ]);
    }
}
