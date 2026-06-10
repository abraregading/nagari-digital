<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    protected $fillable = ['key', 'name', 'icon', 'tagline', 'price', 'period_label', 'savings', 'popular', 'apps', 'is_active', 'order'];

    protected function casts(): array
    {
        return [
            'price' => 'array',
            'period_label' => 'array',
            'savings' => 'array',
            'apps' => 'array',
            'popular' => 'boolean',
        ];
    }

    public function features()
    {
        return $this->hasMany(PricingFeature::class, 'plan_key', 'key')->orderBy('order');
    }
}
