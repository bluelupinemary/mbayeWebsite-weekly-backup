<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPanelDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_panel_design', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('blog_id')->unsigned()->default(0);
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');

            $table->bigInteger('panel_id')->unsigned()->default(0);
            $table->foreign('panel_id')->references('id')->on('game_designed_panels')->onDelete('cascade');

            $table->integer('user_id')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('blog_panel_design');
    }
}
