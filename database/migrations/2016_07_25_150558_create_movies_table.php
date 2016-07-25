<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
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
        Schema::drop('movies');
    }
}
