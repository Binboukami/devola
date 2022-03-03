<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class Todos extends Controller
{
    public function index(){

        $todos = Todo::all();
        return $todos;
    }

    public function store(Request $request){

        $todo = new Todo;
        
        $todo->title = $request->title;
        $todo->content = $request->content;
        $todo->is_done = $request->isDone;
        $todo->date= $request->date;

        $todo->save();

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
