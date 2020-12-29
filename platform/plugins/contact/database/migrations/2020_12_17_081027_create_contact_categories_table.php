<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_vi')->nullable();
            $table->string('name_en')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->default(1);
            $table->mediumText('find_raw')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_categories');
    }
}
