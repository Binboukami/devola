<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Carbon\Carbon;

class Todos extends Controller
{
    public function index(){

        $todos = Todo::all();
        return $todos;
    }

    public function store(Request $request){

      $request->validate([
        "title" => ["required"],
        "content" => ["required"],
        "date" => ["required", "date"]
      ]);

      $todo = Todo::query()->create([

        "title" => $request->title,
        "content" => $request->content,
        "date"=> $request->date
      ]);

      if($todo)
        return $todo;
    }

    public function update(Request $request){

        $todo = Todo::findOrFail($request->id);
        $todo->update($request->all());

        return $todo;
    }
    public function delete(Request $request){
        $todo = Todo::findOrFail($request->id);
        $todo->delete();

        return $todo;
    }
}
