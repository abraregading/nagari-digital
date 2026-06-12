<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\PricingFeature;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{
    public function index()
    {
        $plans = PricingPlan::orderBy('order')->with('features')->get();
        return view('admin.pricing-plans.index', compact('plans'));
    }

    public function edit(PricingPlan $pricingPlan)
    {
        $pricingPlan->load('features');
        return view('admin.pricing-plans.form', ['plan' => $pricingPlan]);
    }

    public function update(Request $request, PricingPlan $pricingPlan)
    {
        $data = $request->validate([
            'name' => 'required', 'tagline' => 'required',
            'price_bulanan' => 'required|numeric|min:0',
            'features' => 'nullable',
        ]);

        $monthly = $data['price_bulanan'];

        $pricingPlan->update([
            'name' => $data['name'],
            'tagline' => $data['tagline'],
            'price' => [
                'bulanan' => $monthly,
                '6bulan' => $monthly * 6,
                'tahunan' => $monthly * 12,
            ],
            'period_label' => [
                'bulanan' => '/bulan',
                '6bulan' => '/6 bulan',
                'tahunan' => '/tahun',
            ],
        ]);

        if ($request->filled('features')) {
            PricingFeature::where('plan_key', $pricingPlan->key)->delete();
            $lines = array_filter(explode("\n", $request->features));
            foreach ($lines as $i => $line) {
                $included = str_starts_with(trim($line), '[x]');
                $text = trim(preg_replace('/^\[x\]\s*|^\[ \]\s*/', '', $line));
                PricingFeature::create([
                    'plan_key' => $pricingPlan->key,
                    'text' => $text, 'included' => $included,
                    'order' => $i + 1,
                ]);
            }
        }

        return redirect()->route('admin.pricing-plans.index')->with('success', 'Paket berhasil diperbarui.');
    }

    public function togglePopular(PricingPlan $pricingPlan)
    {
        PricingPlan::query()->update(['popular' => false]);
        $pricingPlan->update(['popular' => !$pricingPlan->popular]);
        return redirect()->route('admin.pricing-plans.index')->with('success', 'Status popular berhasil diubah.');
    }
}
