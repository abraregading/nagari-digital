<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        $items = WhyChooseUs::orderBy('order')->get();
        return view('admin.why-choose-us.index', compact('items'));
    }

    public function create()
    {
        return view('admin.why-choose-us.form');
    }

    public function store(Request $request)
    {
        WhyChooseUs::create($request->validate([
            'icon' => 'required', 'title' => 'required',
            'description' => 'required', 'order' => 'integer',
        ]));
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(WhyChooseUs $whyChooseU)
    {
        return view('admin.why-choose-us.form', ['item' => $whyChooseU]);
    }

    public function update(Request $request, WhyChooseUs $whyChooseU)
    {
        $whyChooseU->update($request->validate([
            'icon' => 'required', 'title' => 'required',
            'description' => 'required', 'order' => 'integer',
        ]));
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(WhyChooseUs $whyChooseU)
    {
        $whyChooseU->delete();
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Data berhasil dihapus.');
    }
}
