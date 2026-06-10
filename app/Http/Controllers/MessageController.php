<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|min:3',
            'email' => 'nullable|email',
            'whatsapp' => 'required',
            'nagari' => 'required|min:3',
            'paket' => 'nullable',
            'pesan' => 'nullable',
        ]);

        Message::create([
            'name' => $validated['nama'],
            'email' => $validated['email'] ?? '',
            'whatsapp' => $validated['whatsapp'],
            'nagari' => $validated['nagari'],
            'paket' => $validated['paket'] ?? '',
            'pesan' => $validated['pesan'] ?? '',
            'is_read' => false,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
