<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContractTermTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(\App\Models\ContractType::class, 5)->create();
        Model::reguard();
    }
}
