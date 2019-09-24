<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class testQueryUsers extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testQueryUser()
    {
        $response = $this->graphQL('
        {
            user(id: 1) {
                id
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
    public function testQueryUsers()
    {
        $response = $this->graphQL('
        {
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
        ');

        $response->assertDontSee('errors');

    }
}
