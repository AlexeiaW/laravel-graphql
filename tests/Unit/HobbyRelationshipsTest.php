<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Hobby;

class HobbyRelationshipsTest extends TestCase
{
    // use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserAttachHobby()
    {

        $user = factory(User::class)->create();
        $hobby = factory(Hobby::class)->create();

        $user->hobby($hobby);


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

        $user = factory(User::class, 20)->create();


        factory(Hobby::class, 20)->create()->each(function ($hobby) {
            $hobby->save();
            $user = User::find(1);
            $user->hobby($hobby);
        });

        $response = $this->graphQL('
        {
            user(id: 1) {
                id
                name
                hobbies(first: 10) {
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

        // print json_encode($result);
    }
}
