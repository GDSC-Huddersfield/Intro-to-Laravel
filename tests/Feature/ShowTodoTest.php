<?php

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_todo()
    {
        $todo = Todo::factory()->create([
            'name' => "TEST NAME",
            'description' => "TEST DESCRIPTION"
        ]);

        $response = $this->getJson(route('todo.show', $todo->id));

        $response->assertOk();

        $this->assertEquals('TEST NAME', $response->json()['name']);
        $this->assertEquals('TEST DESCRIPTION', $response->json()['description']);
    }

}
