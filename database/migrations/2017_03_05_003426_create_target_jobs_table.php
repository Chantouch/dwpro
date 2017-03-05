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
            $table->enum('status', ['Actively searching', 'Employed but open to opportunities', 'Employed, not open to opportunities']);
            $table->integer('user_id', false, true)->unsigned();
            $table->integer('contract_type_id', false, true)->unsigned();
            $table->enum('desired_salary', ['Unspecified', '0 - 199 USD', '200 - 499 USD', '500 - 999 USD', '1,000 - 1,999 USD', '2,000 USD+']);
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
