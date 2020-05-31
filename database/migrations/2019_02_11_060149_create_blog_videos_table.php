<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id')->unsigned()->index();
            $table->foreign('blog_id')->references('id')->on('blogs')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->string('videourl', 191);
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
        Schema::drop('blog_videos');
    }
}
