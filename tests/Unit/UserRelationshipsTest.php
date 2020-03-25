<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Hobby;

class UserRelationshipsTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHobbyAttachUser()
    {

        $user = factory(User::class)->create();
        $hobby = factory(Hobby::class)->create();

        $hobby->user($user);


        $this->assertDatabaseHas('hobby_user', [
            'hobby_id' => $hobby->id
        ]);

        $this->assertDatabaseHas('hobby_user', [
            'user_id' => $user->id
        ]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserAttachHobbyGraphql()
    {

        $hobbies = factory(Hobby::class, 20)->create();

        $user = factory(User::class, 20)->create()->each(function ($user) {
            $user->save();

            $hobby = Hobby::find(1);
            $hobby->user($user);
        });



        $response = $this->graphQL('
        {
            hobby(id: 1) {
                id
                name
                users(first: 10) {
                    data {
                        id
                        name
                    }
                    paginatorInfo {
                        currentPage
                        lastPage
                    }
                }
            }
        }
        ');

        $response->assertDontSee('errors');

        $result = $response->decodeResponseJson();

        print json_encode($result);
    }
}
