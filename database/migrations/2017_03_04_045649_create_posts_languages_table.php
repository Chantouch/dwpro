<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_languages',function (Blueprint $table){
           $table->increments('id');
           $table->integer('post_id')->unsigned();
           $table->integer('language_id')->unsigned();
           $table->timestamps();
           $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
           $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_languages');
    }
}
