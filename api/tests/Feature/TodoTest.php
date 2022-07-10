<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\DatabaseTransactions;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class TodoTest extends TestCase
{
  
  use DatabaseTransactions;

    /** @test */
    public function it_should_return_a_todo()
    {

      Todo::factory()->createOne(
        [
          "title" => "TDD todo"
        ]
      );

      $this->assertDatabaseHas('todos', ["title" => "TDD todo"]);

      $request = $this->get(route('todos'));

      $request->assertJson(
        array(
          ['title' => 'TDD todo']
      ));
    }
  
}
