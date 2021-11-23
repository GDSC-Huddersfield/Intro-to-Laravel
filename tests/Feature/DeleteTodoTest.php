<?php

use Tests\TestCase;
use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTodoTest extends TestCase
{
   use RefreshDatabase;

   /** @test */
   public function delete_todo()
   {
        $todo = Todo::factory()->create([
            'name' => "TEST NAME",
            'description' => "TEST DESCRIPTION"
        ]);

        $response = $this->delete(route('todo.destroy', $todo->id));

        $response->assertNoContent();
   }

}
