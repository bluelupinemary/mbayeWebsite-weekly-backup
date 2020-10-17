<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateChatGroupsTable extends Migration
{

    public function up() {

        Schema::create('chat_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('image')->nullable();
            $table->integer('created_by')->unsigned();
            $table->timestamps();
           
        });

    }

    public function down() {
        Schema::dropIfExists('chat_groups');
    }

}