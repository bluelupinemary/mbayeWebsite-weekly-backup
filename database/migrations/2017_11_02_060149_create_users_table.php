<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 191)->unique();
            $table->string('username', 191)->unique();
            $table->string('first_name', 191);
            $table->string('last_name', 191);
            $table->string('password', 191);
            $table->boolean('status')->default(1);
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->string('address', 100)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('id_number', 50)->nullable();
            $table->string('sponser_id', 50)->nullable();
            $table->string('sponser_name', 50)->nullable();
            $table->string('mobile_number', 50)->nullable();
            $table->string('org_type', 50)->nullable();
            $table->string('org_name', 50)->nullable();
            $table->string('photo', 191)->nullable();
            $table->string('occupation', 50)->nullable();
            $table->string('member_type', 50)->nullable();
            $table->string('gender', 50)->nullable();
            $table->string('confirmation_code', 191)->nullable();
            $table->boolean('confirmed')->default(0);
            $table->boolean('is_term_accept')->default(0)->comment(' 0 = not accepted,1 = accepted');
            $table->string('remember_token', 100)->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
