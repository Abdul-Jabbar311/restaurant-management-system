<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EditableContent extends Model
{
    protected $fillable = [
        'page',
        'key',
        'content',
    ];
}