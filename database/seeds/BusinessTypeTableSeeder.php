<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BusinessTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(\App\Models\BusinessType::class, 500)->create();
        Model::reguard();
    }
}
