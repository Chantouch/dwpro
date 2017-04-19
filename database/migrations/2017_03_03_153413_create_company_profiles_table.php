<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->nullable();
            $table->integer('employee_id', false, true);
            $table->integer('industry_id', false, true);
            $table->integer('business_type_id', false, true);
            $table->integer('city_id', false, true);
            $table->string('website')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('google_plus')->nullable();
            $table->string('linked_in')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('company_email')->nullable();
            $table->string('logo_photo')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('cover_photo')->nullable();
            $table->integer('number_employee')->nullable();
            $table->string('slug')->nullable();
            $table->string('tag_line')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->tinyInteger('currently_hiring')->default(1);
            $table->longText('about_us')->nullable();
            $table->longText('how_we_work')->nullable();
            $table->longText('looking_for')->nullable();
            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');
            $table->foreign('business_type_id')->references('id')->on('business_types')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_profiles');
    }
}
