<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('season_id')->unsigned();
            $table->integer('number')->unsigned()->nullable();
            $table->string('title');
            $table->string('genre')->nullable();
            $table->decimal('rating',5,2)->nullable();
            $table->text('summary')->nullable();
            $table->string('url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->index('title');
            $table->index('genre');
            $table->index('rating');
            $table->index('url');
            $table->foreign('season_id')->references('id')->on('seasons');
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
        Schema::drop('episodes');
    }
}
