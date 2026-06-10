<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['icon', 'title', 'description', 'features', 'link', 'color', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['features' => 'array'];
    }
}
