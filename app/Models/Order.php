<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'pricing_plan_id', 'duration', 'invoice', 'amount', 'status',
        'payment_method', 'payment_channel', 'transaction_id',
        'payment_details', 'paid_at', 'activated_at',
    ];

    public function getDurationLabel(): string
    {
        return match ($this->duration) {
            '1month' => '1 Bulan',
            '6month' => '6 Bulan',
            '12month' => '1 Tahun',
            default => '-',
        };
    }

    protected function casts(): array
    {
        return [
            'payment_details' => 'array',
            'paid_at' => 'datetime',
            'activated_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }

    public function getTaxRate(): float
    {
        return config('company.tax_rate', 11);
    }

    public function getSubtotal(): float
    {
        $rate = $this->getTaxRate();
        return round($this->amount / (1 + $rate / 100));
    }

    public function getTaxAmount(): float
    {
        return $this->amount - $this->getSubtotal();
    }
}
