<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateGroupMessagesTable extends Migration
{

    public function up() {

        Schema::create('group_messages', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('sender_id')->unsigned();
            $table->integer('group_id')->unsigned();
            $table->text('message')->nullable();
            $table->timestamps();
        });

    }

    public function down() {
        Schema::dropIfExists('group_messages');
    }

}