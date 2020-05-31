<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePushNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('push_notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('message', 191);
            $table->integer('user_id')->unsigned()->index('push_notifications_user_id_foreign');
            $table->boolean('type')->default(1)->comment('1 - Dashboard , 2 - Email , 3 - Both');
            $table->boolean('is_read')->default(0);
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
        Schema::drop('push_notifications');
    }
}
