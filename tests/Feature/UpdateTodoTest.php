<?php

use Tests\TestCase;
use App\Models\Todo;
use Database\Factories\TodoFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function update_todo_test()
    {
        $todo = Todo::factory()->create();

        $response = $this->putJson(route('todo.update', $todo->id), [
            'name' => "TEST NAME",
            'description' => "TEST DESCRIPTION"
        ]);

        $response->assertOk();

        $this->assertEquals('TEST NAME', $response->json()['name']);
        $this->assertEquals('TEST DESCRIPTION', $response->json()['description']);
    }
}
