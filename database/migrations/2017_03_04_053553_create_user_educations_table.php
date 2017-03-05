<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('school_name')->nullable();
            $table->string('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('is_studying')->nullable(0);
            $table->integer('country_id')->unsigned();
            $table->integer('city_id')->unsigned();
            $table->string('field_of_study')->nullable();
            $table->string('grade')->nullable();
            $table->integer('level_id')->unsigned();
            $table->integer('user_id')->insigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_educations');
    }
}
