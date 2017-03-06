<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(30),
    ];
});

$factory->define(\App\Employee::class, function (\Faker\Generator $faker) {
    static $password;
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(30),
        'role' => 'employee',
        'verified_by' => mt_rand(1, 5),
    ];
});

$factory->define(\App\Admin::class, function (\Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('password'),
        'remember_token' => str_random(30),
        'role' => 'admin',
    ];
});

$factory->define(\App\Models\BusinessType::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\City::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\ContractType::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\Department::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\Functions::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\Industry::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\Language::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\Level::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\Position::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});

$factory->define(\App\Models\Qualification::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'status' => 1
    ];
});


$factory->define(\App\Models\CompanyProfile::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'employee_id' => rand(1,50),
        'industry_id' => mt_rand(1, 500),
        'description' => $faker->paragraph,
        'business_type_id' => mt_rand(1, 500),
        'city_id' => mt_rand(1, 25),
        'website' => $faker->url,
        'address' => $faker->address,
        'company_email' => $faker->safeEmail,
        'number_employee' => rand(5, 500),
        'slug' => $faker->slug,
        'tag_line' => $faker->word,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'confirm_code' => str_random(10),
        'temp_enroll_no' => str_random(10),
        'enroll_no' => $faker->randomNumber()
    ];
});
