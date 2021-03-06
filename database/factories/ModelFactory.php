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
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(30),
        'slug' => $faker->slug,
        'verified_by' => mt_rand(0, 5),
        'status' => mt_rand(0, 1),
        'avatar' => $faker->image(),
        'avatar_path' => $faker->imageUrl()
    ];
});


$factory->define(\App\Models\UserProfile::class, function (\Faker\Generator $faker) {
    return [
        'about_me' => $faker->paragraph,
        'cover_letter' => $faker->paragraph,
        'address' => $faker->address,
        'user_id' => mt_rand(1, 5),
        'date_of_birth' => $faker->date(),
        'city_id' => mt_rand(1, 25),
        'country_id' => '1',
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
        'slug' => $faker->slug,
        'avatar' => $faker->image(),
        'avatar_path' => $faker->imageUrl(),
        'confirm_code' => str_random(10),
        'temp_enroll_no' => str_random(10),
        'enroll_no' => $faker->randomNumber(),
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
        'slug' => $faker->slug,
        'avatar' => $faker->image(),
        'avatar_path' => $faker->imageUrl()
    ];
});

$factory->define(\App\Models\BusinessType::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Contact::class, function (\Faker\Generator $faker) {
    return [
        'parent_id' => mt_rand(1, 5),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->phoneNumber,
        'role' => 'contact',
        'verified_by' => mt_rand(1, 5),
        'department_id' => mt_rand(1, 5),
        'position_id' => mt_rand(1, 5),
        'slug' => $faker->slug,
        'avatar' => $faker->image(),
        'avatar_path' => $faker->imageUrl()
    ];
});

$factory->define(\App\Models\City::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\ContractType::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Department::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Functions::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Industry::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Language::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Level::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Position::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});

$factory->define(\App\Models\Qualification::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => 1
    ];
});


$factory->define(\App\Models\CompanyProfile::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'employee_id' => mt_rand(1, 50),
        'industry_id' => mt_rand(1, 5),
        'how_we_work' => $faker->paragraph,
        'looking_for' => $faker->paragraph,
        'about_us' => $faker->paragraph,
        'currently_hiring' => mt_rand(0, 1),
        'business_type_id' => mt_rand(1, 5),
        'city_id' => mt_rand(1, 25),
        'website' => $faker->url,
        'address' => $faker->address,
        'company_email' => $faker->safeEmail,
        'number_employee' => rand(5, 5),
        'slug' => $faker->slug,
        'tag_line' => $faker->word,
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
        'phone_number' => $faker->phoneNumber
    ];
});

$factory->define(\App\Models\Post::class, function (\Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'post_id' => $faker->unique()->numberBetween(1, 50),
        'job_description' => $faker->paragraph,
        'slug' => $faker->slug,
        'status' => mt_rand(0, 1),
        'age_from' => mt_rand(18, 30),
        'age_to' => mt_rand(31, 60),
        'city_id' => mt_rand(1, 25),
        'closing_date' => $faker->date(),
        'contact_id' => mt_rand(1, 50),
        'contract_type_id' => mt_rand(1, 5),
        'employee_id' => mt_rand(1, 50),
        'field_of_study' => $faker->word,
        'functions_id' => mt_rand(1, 5),
        'gender' => null,
        'hire_number' => mt_rand(1, 10),
        'industry_id' => mt_rand(1, 5),
        'level_id' => mt_rand(1, 5),
        'marital_status' => null,
        'published_date' => $faker->date(),
        'qualification_id' => mt_rand(1, 5),
        'requirement_des' => $faker->paragraph,
        'salary' => null,
        'year_experience' => null,
    ];
});
