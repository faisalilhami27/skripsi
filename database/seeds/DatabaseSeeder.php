<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(JenisPemesananSeeder::class);
        $this->call(StatusPembayaranSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(UserLevelSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleLevelSeeder::class);
        $this->call(KonfigurasiSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
