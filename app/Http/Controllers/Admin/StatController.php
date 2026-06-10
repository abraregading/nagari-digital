<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        $stats = Stat::orderBy('order')->get();
        return view('admin.stats.index', compact('stats'));
    }

    public function create()
    {
        return view('admin.stats.form');
    }

    public function store(Request $request)
    {
        Stat::create($request->validate([
            'icon' => 'required', 'count' => 'required|numeric',
            'suffix' => 'required', 'label' => 'required', 'order' => 'integer',
        ]));
        return redirect()->route('admin.stats.index')->with('success', 'Statistik berhasil ditambahkan.');
    }

    public function edit(Stat $stat)
    {
        return view('admin.stats.form', compact('stat'));
    }

    public function update(Request $request, Stat $stat)
    {
        $stat->update($request->validate([
            'icon' => 'required', 'count' => 'required|numeric',
            'suffix' => 'required', 'label' => 'required', 'order' => 'integer',
        ]));
        return redirect()->route('admin.stats.index')->with('success', 'Statistik berhasil diperbarui.');
    }

    public function destroy(Stat $stat)
    {
        $stat->delete();
        return redirect()->route('admin.stats.index')->with('success', 'Statistik berhasil dihapus.');
    }
}
