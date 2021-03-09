<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareStoriesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('care_stories_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('care_story_id')->unsigned()->index();
            $table->foreign('care_story_id')->references('id')->on('care_stories')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->string('imageurl', 191);
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
        Schema::dropIfExists('care_stories_images');
    }
}
