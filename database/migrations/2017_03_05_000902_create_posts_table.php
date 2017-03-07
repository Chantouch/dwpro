<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('hire_number')->nullable();
            $table->integer('industry_id', false, true)->unsigned()->nullable();
            $table->integer('function_id', false, true)->unsigned()->nullable();
            $table->integer('city_id', false, true)->unsigned()->nullable();
            $table->decimal('salary')->nullable()->nullable();
            $table->longText('job_description')->nullable();
            $table->integer('level_id', false, true)->unsigned()->nullable();
            $table->integer('contract_type_id', false, true)->nullable()->comment('Can be Term like full time,..........');
            $table->integer('year_experience')->nullable();
            $table->integer('qualification_id', false, true)->unsigned()->nullable();
            $table->string('field_of_study')->nullable();
            $table->enum('gender', ['', 'Male', 'Female'])->nullable();
            $table->integer('age_from')->nullable();
            $table->integer('age_to')->nullable();
            $table->enum('marital_status', ['', 'Single', 'Married'])->nullable();
            $table->longText('requirement_des')->nullable();
            $table->integer('contact_id', false, true)->unsigned()->nullable();
            $table->integer('employee_id', false, true)->unsigned()->nullable();
            $table->tinyInteger('status')->default(1);
            $table->date('closing_data')->nullable();
            $table->date('published_date')->nullable();
            $table->timestamps();

            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');
            $table->foreign('function_id')->references('id')->on('functions')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('qualification_id')->references('id')->on('qualifications')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
