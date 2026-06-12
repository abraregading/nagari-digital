<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function edit($key)
    {
        $setting = Setting::where('key', $key)->firstOrFail();
        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request, $key)
    {
        $setting = Setting::where('key', $key)->firstOrFail();
        $setting->update(['value' => $request->input('value')]);
        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function updateAll(Request $request)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            Setting::set($key, $value);
        }
        return redirect()->route('admin.settings.index')->with('success', 'Semua pengaturan berhasil disimpan.');
    }

    public function printOutIndex()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('admin.settings.print-out', compact('settings'));
    }

    public function updatePrintOut(Request $request)
    {
        $keys = [
            'invoice_header', 'invoice_footer', 'invoice_terms',
            'invoice_bank_name', 'invoice_bank_account', 'invoice_bank_holder',
            'invoice_signatory',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::set($key, $request->input($key));
            }
        }

        return redirect()->route('admin.settings.print-out')
            ->with('success', 'Pengaturan invoice berhasil disimpan.');
    }
}
