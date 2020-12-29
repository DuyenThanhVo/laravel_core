<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAclTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('users', function (Blueprint $table) {
            $table->text('permissions')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('username', 60)->nullable()->unique()->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->boolean('super_user')->default(0);
            $table->boolean('manage_supers')->default(0);
            $table->string('password')->nullable()->change();
        });*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('users');
    }
}
