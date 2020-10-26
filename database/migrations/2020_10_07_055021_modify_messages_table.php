<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class ModifyMessagesTable extends Migration
{

    public function up() {

        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['receiver_id','file','group_id','user_id']);
            $table->integer('sender_id')->after('id')->unsigned();
            $table->integer('conversation_id')->after('message')->unsigned();
            
        });

    }

    public function down() {
        Schema::table('messages', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('receiver_id')->unsigned()->nullable();
            $table->integer('group_id')->unsigned()->nullable();
            $table->string('file')->nullable();
            $table->dropColumn('sender_id');
            $table->dropColumn('conversation_id');
        });
    }
}