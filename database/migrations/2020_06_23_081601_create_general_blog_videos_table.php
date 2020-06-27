<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralBlogVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_blog_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_id')->unsigned()->index();
            $table->foreign('blog_id')->references('id')->on('general_blogs')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
        Schema::dropIfExists('general_blog_videos');
    }
}
