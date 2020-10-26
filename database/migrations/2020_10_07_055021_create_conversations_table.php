<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{

    public function up() {

        Schema::create('conversations', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('user1_id')->unsigned();
            $table->integer('user2_id')->unsigned();
            $table->timestamps();
        });

    }

    public function down() {
        Schema::dropIfExists('conversations');
    }

}