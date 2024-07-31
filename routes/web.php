<?php

use App\Livewire\LivePreview;
use App\Models\Broadcast; // Pastikan nama model menggunakan huruf kapital dan konsisten
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kon', function () {
    return view('msg');
});

Route::get('/package', function () {
    return view('package');
});

Route::get('/template', function () {
    return view('templatemsg');
});

Route::get('/broadcast', function () {
    return view('bc');
});

Route::post('/broadcast', function () {
    $data = request()->validate([
        'bcname' => 'required|string|max:300',
        'template' => 'nullable|string',
        'kontak' => 'nullable|string',
        'schedule' => 'required|date',
        'message' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,heic|max:1024',
        'showButton' => 'required|boolean',
        'buttonText' => 'nullable|string|max:255', 
        'buttonUrl' => 'nullable|string|max:255|url', 
    ]);

    $broadcast = new Broadcast($data);

    if (request()->hasFile('image')) {
        $broadcast->image = request()->file('image')->store('images', 'public');
    }

    $broadcast->save();

    return redirect('/broadcast')->with('message', 'Broadcast saved successfully!');
});

Route::get('/broadcastlist', function () {
    return view('bc_list');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/live', LivePreview::class);
