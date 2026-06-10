<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingFeature extends Model
{
    protected $fillable = ['plan_key', 'text', 'included', 'order'];

    protected function casts(): array
    {
        return ['included' => 'boolean'];
    }
}
