<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralBlogSharesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_blog_shares', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('general_blog_id')->unsigned()->index();
            $table->foreign('general_blog_id')->references('id')->on('general_blogs')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        Schema::dropIfExists('general_blog_shares');
    }
}
