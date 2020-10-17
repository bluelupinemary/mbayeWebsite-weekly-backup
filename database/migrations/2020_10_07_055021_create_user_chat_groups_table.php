<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateUserChatGroupsTable extends Migration
{

    public function up() {

        Schema::create('User_chat_groups', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->foreign('user_id')->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table->timestamps();
        });

    }

    public function down() {
        Schema::dropIfExists('user_chat_groups');
    }

}