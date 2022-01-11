<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameRelationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('table_project_text');
        Schema::create('project_text', function (Blueprint $table) {
            $table->bigInteger('project_id')->unsigned();
            $table->bigInteger('text_id')->unsigned();

            $table->unique(['project_id', 'text_id']);
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('text_id')->references('id')->on('texts')
                ->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_text');
    }
}
