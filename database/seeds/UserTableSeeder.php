<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(User::class, 10)->create()->each(function ($user) {
            $user->profile()->save(factory(\App\Models\UserProfile::class)->make());
        });
        Model::reguard();
    }
}
