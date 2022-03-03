<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'is_done', 'date'];
    protected $casts = [
        'is_done' => 'boolean',
        'is_editing' => 'boolean'
    ];
}
