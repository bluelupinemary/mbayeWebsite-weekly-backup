<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->dateTime('publish_datetime')->nullable();
            $table->string('featured_image', 191)->nullable();
            $table->text('content');
            $table->string('meta_title', 191)->nullable();
            $table->string('cannonical_link', 191)->nullable();
            $table->string('slug', 191)->nullable();
            $table->text('meta_description', 65535)->nullable();
            $table->text('meta_keywords', 65535)->nullable();
            $table->enum('status', ['Published', 'Draft', 'InActive', 'Scheduled', 'Unpublished']);
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
        Schema::dropIfExists('general_blogs');
    }
}
