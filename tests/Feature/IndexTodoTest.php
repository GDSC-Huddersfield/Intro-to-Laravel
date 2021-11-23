<?php

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_all_todo()
    {
        $todo = Todo::factory()->create([
            'name' => "TEST NAME",
            'description' => "TEST DESCRIPTION"
        ]);

        $response = $this->getJson(route('todo.index'));

        $response->assertOk();

        $this->assertCount(1, $response->json());

        $this->assertEquals('TEST NAME', $response->json()[0]['name']);
        $this->assertEquals('TEST DESCRIPTION', $response->json()[0]['description']);
    }


}
