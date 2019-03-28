<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMstUserCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_user_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 60);
            $table->string('username', 20);
            $table->string('email', 60);
            $table->string('password', 60);
            $table->string('no_hp', 15);
            $table->enum('status' ,['y', 'n']);
            $table->text('images')->nullable();
            $table->string('api_token', 210)->nullable()->unique();
            $table->string('player_id', 100)->nullable()->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_user_customer');
    }
}
