<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(User::class, 50)->create()->each(function ($user) {
            // Associate the user with a hobby
            $user->hobby(rand(1, 50));
            $user->save();
        });
    }
}
