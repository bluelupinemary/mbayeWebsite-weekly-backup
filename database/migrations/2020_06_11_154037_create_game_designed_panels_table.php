<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameDesignedPanelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_designed_panels', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('design_id')->unsigned()->default(0);
            $table->foreign('design_id')->references('id')->on('game_user_design')->onDelete('cascade');
            $table->text('panel_number');
            $table->text('screenshot');
            $table->longText('flowers_used');
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
        Schema::dropIfExists('game_designed_panels');
    }
}
