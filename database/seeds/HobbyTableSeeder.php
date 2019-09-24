<?php

use Illuminate\Database\Seeder;
use App\Hobby;

class HobbyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Hobby::class, 50)->create();
    }
}
