<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('slug')->nullable();
            $table->integer('verified_by', false, true)->nullable();
            $table->string('phone_number')->nullable();
            $table->string('password')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->enum('gender', ['0', '1', '2', '3'])->default('3');
            $table->string('enroll_id')->nullable();
            $table->string('enroll_temp')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_path')->nullable();
            $table->string('confirm_code')->nullable();
            $table->enum('verified_status', ['verified', 'unverified'])->default('unverified');
            $table->integer('terms')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('verified_by')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
