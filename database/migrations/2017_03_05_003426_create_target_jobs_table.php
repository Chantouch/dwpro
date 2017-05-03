<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['1', '2', '3']);
            $table->integer('user_id', false, true)->unsigned();
            $table->integer('contract_type_id', false, true)->unsigned();
            $table->enum('desired_salary', ['0', '1', '2', '3', '4', '5']);
            $table->integer('industry_id', false, true)->unisgned();
            $table->integer('city_id', false, true)->unisgned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('target_jobs');
    }
}
