<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutSectionController extends Controller
{
    public function index()
    {
        $sections = AboutSection::orderBy('order')->get();
        return view('admin.about-sections.index', compact('sections'));
    }

    public function edit(AboutSection $aboutSection)
    {
        return view('admin.about-sections.form', ['section' => $aboutSection]);
    }

    public function update(Request $request, AboutSection $aboutSection)
    {
        $data = $request->validate(['content' => 'required']);
        $content = $aboutSection->type === 'story_paragraphs'
            ? array_filter(explode("\n\n", $request->content))
            : ($aboutSection->type === 'vision' || $aboutSection->type === 'story_highlight'
                ? $request->content
                : json_decode($request->content, true) ?? $request->content);
        $aboutSection->update(['content' => $content]);
        return redirect()->route('admin.about-sections.index')->with('success', 'Konten berhasil diperbarui.');
    }
}
