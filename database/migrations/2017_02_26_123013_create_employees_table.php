<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id', false, true)->default(0);
            $table->integer('department_id', false, true)->nullable();
            $table->integer('position_id', false, true)->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->nullable();
            $table->string('role')->default('employee')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('password')->nullable();
            $table->integer('verified_by', false, true)->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_path')->nullable();
            $table->string('confirm_code')->nullable();
            $table->string('temp_enroll_no')->nullable();
            $table->string('enroll_no')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('verified_by')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
