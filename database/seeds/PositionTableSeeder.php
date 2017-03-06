<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(\App\Models\Position::class, 500)->create();
        Model::reguard();
    }
}
