<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('special_number');
            $table->string('country', 50);
            $table->integer('user_id')->unsigned()->unique()->index('user_number_id_foreign');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::drop('user_numbers');
    }
}
