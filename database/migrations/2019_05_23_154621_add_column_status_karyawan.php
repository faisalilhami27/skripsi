<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
  {
    Schema::table('karyawan', function (Blueprint $table) {
      $table->integer('status')->nullable()->after('no_hp')->default(0);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('karyawan', function (Blueprint $table) {
      $table->dropColumn('status');
    });
  }
}
