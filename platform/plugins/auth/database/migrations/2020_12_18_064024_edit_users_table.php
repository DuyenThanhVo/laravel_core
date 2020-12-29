<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('gender')->default(1);
            $table->string('phone')->nullable();
            $table->tinyInteger('affilate')->default(0);
            $table->bigInteger('user_code')->nullable();
            $table->integer('fcode')->nullable();
            $table->string('token_aff_sys')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->integer('level')->default(1);
            $table->string('logo')->nullable();
            $table->string('token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
