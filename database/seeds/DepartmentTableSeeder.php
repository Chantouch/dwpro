<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(\App\Models\Department::class, 5)->create();
        Model::reguard();
    }
}
