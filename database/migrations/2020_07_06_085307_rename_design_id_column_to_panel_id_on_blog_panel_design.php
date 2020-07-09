<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameDesignIdColumnToPanelIdOnBlogPanelDesign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blog_panel_design', function (Blueprint $table) {
            $table->renameColumn('design_id', 'panel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blog_panel_design', function (Blueprint $table) {
            //
        });
    }
}
