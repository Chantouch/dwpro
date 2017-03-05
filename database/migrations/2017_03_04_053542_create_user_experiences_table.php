<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_title')->nullable();
            $table->string('description')->nullable();
            $table->string('company_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('is_working')->nullable(0);
            $table->integer('country_id', false, true)->unsigned();
            $table->integer('city_id', false, true)->unsigned();
            $table->integer('contract_id', false, true)->ungigned()->nullable();
            $table->integer('industry_id', false, true)->unsigned();
            $table->string('role')->nullable();
            $table->integer('level_id', false, true)->unsigned();
            $table->integer('user_id', false, true)->insigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');
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
        Schema::dropIfExists('user_experiences');
    }
}
