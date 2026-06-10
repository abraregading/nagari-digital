<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'icon' => 'required', 'question' => 'required',
            'answer' => 'required', 'order' => 'integer',
        ]);
        $data['answer'] = '<p>' . nl2br(e($request->answer)) . '</p>';
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.form', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'icon' => 'required', 'question' => 'required',
            'answer' => 'required', 'order' => 'integer',
        ]);
        $data['answer'] = '<p>' . nl2br(e($request->answer)) . '</p>';
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
