<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_todo_test()
    {
        $response = $this->postJson(route('todo.store'), [
            'name' => "TEST NAME",
            'description' => "TEST DESCRIPTION"
        ]);

        $response->assertCreated();

        $this->assertEquals('TEST NAME', $response->json()['name']);
        $this->assertEquals('TEST DESCRIPTION', $response->json()['description']);
    }

}
