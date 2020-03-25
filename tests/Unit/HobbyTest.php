<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Hobby;

class CreateHobbyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateHobbyThroughEleqount()
    {
        $hobby = factory(Hobby::class)->create();

        $this->assertDatabaseHas('hobbies', [
            'id' => $hobby->id
        ]);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testQueryHobbiesThroughGraphql()
    {
        $hobby = factory(Hobby::class)->create();

        $this->assertDatabaseHas('hobbies', [
            'id' => $hobby->id
        ]);

        $response = $this->graphQL('
        {
            hobbies {
                id
                name
            }
        }
        ');

        $response->assertDontSee('errors');
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testQueryHobbyThroughGraphql()
    {
        $hobby = factory(Hobby::class)->create();

        $this->assertDatabaseHas('hobbies', [
            'id' => $hobby->id
        ]);

        $response = $this->graphQL('
        {
            hobby(id: 1) {
                name
            }
        }
        ');

        $result = $response->decodeResponseJson();

        // print json_encode($result);

        $response->assertDontSee('errors');
    }
}
