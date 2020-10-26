<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id');
            // $table->foreign('blog_id')->references('id')->on('blogs')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->text('caption');
            $table->integer('created_by')->unsigned();
            $table->dateTime('publish_datetime')->nullable();
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
        Schema::dropIfExists('blog_shares');
    }
}
