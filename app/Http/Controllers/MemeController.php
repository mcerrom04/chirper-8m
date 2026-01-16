<?php

namespace App\Http\Controllers;

use App\Models\Meme;
use Illuminate\Http\Request;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memes = Meme::with('user')
            ->latest()
            ->take(50)
            ->get();

        return view('home', ['memes' => $memes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'image_url' => 'nullable|url|max:1000',
        ], [
            'message.required' => 'Escribe algo antes de publicar.',
            'message.max' => 'El mensaje no puede superar los 255 caracteres.',
            'image_url.url' => 'La URL de la imagen debe ser válida.',
        ]);

        $meme = new Meme();
        $meme->message = $validated['message'];
        $meme->image_url = $validated['image_url'] ?? null;
        $meme->user_id = null; // anónimo por ahora
        $meme->save();

        return redirect('/')->with('success', 'Meme publicado correctamente. Gracias.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meme $meme)
    {
        return view('memes.edit', compact('meme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meme $meme)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
            'image_url' => 'nullable|url|max:1000',
        ], [
            'message.required' => 'Escribe algo antes de publicar.',
            'message.max' => 'El mensaje no puede superar los 255 caracteres.',
            'image_url.url' => 'La URL de la imagen debe ser válida.',
        ]);

        $meme->update([
            'message' => $validated['message'],
            'image_url' => $validated['image_url'] ?? null,
        ]);

        return redirect('/')->with('success', 'Meme actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meme $meme)
    {
        $meme->delete();

        return redirect('/')->with('success', 'Meme eliminado.');
    }
}