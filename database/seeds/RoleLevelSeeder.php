<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_level')->insert([
            [
                'id_user_level' => 1,
                'id_menu' => 1,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 2,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 3,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 4,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 5,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 6,
                'create' => 0,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 7,
                'create' => 0,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 8,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 9,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 10,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
