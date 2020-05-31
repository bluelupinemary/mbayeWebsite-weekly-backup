<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersContactsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_contacts_details', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('contact_id')->unsigned()->default(0);
            $table->foreign('contact_id')->references('id')->on('user_contacts')->onDelete('cascade');

            $table->text('name');
            $table->string('email', 191)->unique();
            $table->string('mobile_number', 50)->nullable();
            $table->text('alias')->nullable();
            $table->text('planet')->nullable();
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
        Schema::dropIfExists('users_contacts_details');
    }
}
