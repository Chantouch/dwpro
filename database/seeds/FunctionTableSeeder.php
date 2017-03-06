<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FunctionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(\App\Models\Functions::class, 500)->create();
        Model::reguard();
    }
}
