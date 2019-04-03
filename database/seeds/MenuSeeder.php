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
                'title' => 'Kelola Karyawan',
                'url' => 'karyawan',
                'icon' => 'icon icon-user-plus',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Pengguna',
                'url' => 'user',
                'icon' => 'icon icon-user',
                'is_main_menu' => 0,
                'is_aktif' => 'y'
            ],
            [
                'title' => 'Kelola Customer',
                'url' => 'customer',
                'icon' => 'icon icon-user-plus',
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
            ],
        ]);
    }
}
