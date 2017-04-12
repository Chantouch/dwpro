<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(\App\Models\Level::class, 5)->create();
        Model::reguard();
    }
}
