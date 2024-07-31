<?php

namespace App\Http\Controllers;

use App\Models\Broadcast;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BroadcastController extends Controller
{
    public function store(Request $request)
    {
$broadcast = Broadcast::create($request->all());
        // Validasi input
        $validated = $request->validate([
            'bcname' => 'required|string|max:300',
            'waktu' => 'required|date',
            'message' => 'nullable|string|max:1000',
            'namabutton' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,heic|max:1024',
        ]);

        // Buat instance model dan isi dengan data validasi
        $broadcast = new Broadcast($validated);

        // Jika ada file gambar yang diunggah, simpan dan set path gambar
        if ($request->hasFile('image')) {
            $broadcast->image = $request->file('image')->store('images', 'public');
        }

        // Simpan data ke database
        $broadcast->save();

        // Redirect dengan pesan sukses
        return redirect('/broadcast')->with('message', 'Broadcast saved successfully!');
    }
}
