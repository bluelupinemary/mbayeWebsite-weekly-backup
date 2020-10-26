<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateChatMediaTable extends Migration
{

    public function up() {

        Schema::create('chat_media', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('filename', 191);
            $table->string('filetype', 191);
            $table->integer('message_id')->unsigned();
            $table->string('message_type');
            $table->timestamps();
        });

    }

    public function down() {
        Schema::dropIfExists('chat_media');
    }

}