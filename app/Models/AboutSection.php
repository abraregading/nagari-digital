<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $fillable = ['type', 'label', 'content', 'order', 'is_active'];

    protected function casts(): array
    {
        return ['content' => 'array'];
    }
}
