<?php

use App\Http\Controllers\Todos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todos', [Todos::class, 'index'])->name('todos');

Route::post('/todos', [Todos::class, 'store']);

Route::put('/todos/{id}', [Todos::class, 'update']);

Route::delete('/todos/{id}', [Todos::class, 'delete']);
