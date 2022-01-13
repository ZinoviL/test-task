<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilmControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_list()
    {
        $response = $this->get('/api/films');
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $response = $this->get('/api/films/1');
        $response->assertStatus(200);
    }

    public function test_show_non_existing_film()
    {
        $response = $this->get('/api/films/0');
        $response->assertStatus(404);
    }

    public function test_store()
    {
        $response = $this->post('/api/films', ['name' => 'awdawd', 'description' => 'awdawdawdawdawdawd', 'genre_id' => 1, 'actors' => [1, 2]]);
        $response->assertStatus(200);
    }

    public function test_store_with_incorrect_data()
    {
        $response = $this->post('/api/films', ['name' => 'awdawd', 'description' => 'awdawdawdawdawdawd', 'genre_id' => 0, 'actors' => [1, 2]]);
        $response->assertStatus(400);
    }

    public function test_update()
    {
        $response = $this->put('/api/films/1', ['name' => 'awdawd']);
        $response->assertStatus(200);
    }

    public function test_update_non_existing_film()
    {
        $response = $this->put('/api/films/0', ['name' => 'awdawd']);
        $response->assertStatus(404);
    }

    public function test_delete()
    {
        $response = $this->delete('/api/films/1');
        $response->assertStatus(200);
    }

    public function test_delete_non_existing_film()
    {
        $response = $this->delete('/api/films/0');
        $response->assertStatus(404);
    }
}
