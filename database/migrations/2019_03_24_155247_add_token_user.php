<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mst_user_karyawan', function (Blueprint $table) {
            $table->string('api_token', 255)->after('status')
                ->unique()
                ->nullable()
                ->default(null);
        });

        Schema::table('mst_user_customer', function ($table) {
            $table->string('api_token', 255)->after('images')
                ->unique()
                ->nullable()
                ->default(null);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mst_user_karyawan', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
        Schema::table('mst_user_customer', function (Blueprint $table) {
            $table->dropColumn('api_token');
        });
    }
}
