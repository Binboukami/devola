<?php

namespace Tests\Feature\Todo;

use Tests\TestCase;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTodoTest extends TestCase
{

  use DatabaseTransactions;

  /** @test */
  public function it_should_create_a_todo()
  {
      $response = $this->post('/api/todos',
      [
        "title" => "TDD todo",
        "content" => "Testando",
        "date" => Carbon::now()->addDays(3)
      ]);

      $response->assertSuccessful();

      $this->assertDatabaseHas('todos',
      [
        "title" => "TDD todo",
        "content" => "Testando"
      ]);

  }

    /** @test */
  public function title_should_be_required()
  {
      // assertions
      $this->post('/api/todos', [])
          ->assertSessionHasErrors(
            [
              "title" => __('validation.required', ['attribute' => 'title']) 
            ]
          );
  }

  /** @test */
  public function contet_should_be_required()
  {
      $this->post('/api/todos', [])
        ->assertSessionHasErrors((
          [
            "content" => __('validation.required', ['attribute' => 'content'])
          ]
          ));
  }

  /** @test */
  public function date_should_be_required()
  {
    $this->post('/api/todos', [])
    ->assertSessionHasErrors((
      [
        "date" => __('validation.required', ['attribute' => 'date'])
      ]
    ));
  }

  /** @test */
  public function date_should_be_a_date()
  {
    $this->post('/api/todos', [
      "date" => "Not a date"
    ])
    ->assertSessionHasErrors((
      [
        "date" => __('validation.date', ['attribute' => 'date'])
      ]
    ));
  }

  /**
   * @test
   * @todo
  */
  public function date_should_be_after_now ()
  {
    // arrange
    $now = Carbon::now();

    // action
    $this->post('/api/todos', [
      "title" => "TDD todo",
      'content' => "Testando tempo",
      "date" => Carbon::now()->subDays(3)
    ])
    ->assertSessionHasErrors([
      "date" => __('validation.after:date', ['attribute' => 'date'])
    ]);
  
  }

  /** @test */
  public function is_done_should_default_to_false()
  {
    $this->post('/api/todos', 
      [
        "title" => "TDD todo",
        "content" => "Todo NÃO deve estar pronto",
        "date" => Carbon::now()->addDays(1)
      ]
    )->assertSuccessful();

    $this->assertDatabaseHas('todos',
      [
        "title" => "TDD todo",
      ]
    );

    /** @var Todo $todo */
    $todo = Todo::query()->where('title', "TDD todo")->first();

    $this->assertFalse($todo->is_done);
  }

}