<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Employee;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(Employee::class, 5)->create()->each(function ($post) {
//            $post->posts()->save(factory(\App\Models\Post::class)->make());
            $post->company_profile()->save(factory(\App\Models\CompanyProfile::class)->make());
        });
        Model::reguard();
    }
}

        
