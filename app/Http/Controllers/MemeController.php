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
            'message' => 'nullable|string|max:255',
            'image_url' => 'nullable|url|max:1000',
            'explicacion' => 'required|string|max:1000',
        ], [
            'message.max' => 'El mensaje no puede superar los 255 caracteres.',
            'image_url.url' => 'La URL de la imagen debe ser válida.',
            'explicacion.required' => 'La explicación que desmiente el meme/bulo es obligatoria.',
            'explicacion.max' => 'La explicación no puede superar los 1000 caracteres.',
        ]);

        // Validar que al menos message o image_url esté presente
        if (empty($validated['message']) && empty($validated['image_url'])) {
            return back()->withErrors(['message' => 'Debes proporcionar un mensaje o una URL de imagen.'])->withInput();
        }

        // Create meme attached to authenticated user
        auth()->user()->memes()->create([
            'message' => $validated['message'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'explicacion' => $validated['explicacion'],
        ]);

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
        $this->authorize('update', $meme);
        return view('memes.edit', compact('meme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meme $meme)
    {
        $this->authorize('update', $meme);
        $validated = $request->validate([
            'message' => 'nullable|string|max:255',
            'image_url' => 'nullable|url|max:1000',
            'explicacion' => 'required|string|max:1000',
        ], [
            'message.max' => 'El mensaje no puede superar los 255 caracteres.',
            'image_url.url' => 'La URL de la imagen debe ser válida.',
            'explicacion.required' => 'La explicación que desmiente el meme/bulo es obligatoria.',
            'explicacion.max' => 'La explicación no puede superar los 1000 caracteres.',
        ]);

        // Validar que al menos message o image_url esté presente
        if (empty($validated['message']) && empty($validated['image_url'])) {
            return back()->withErrors(['message' => 'Debes proporcionar un mensaje o una URL de imagen.'])->withInput();
        }

        $meme->update([
            'message' => $validated['message'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'explicacion' => $validated['explicacion'],
        ]);

        return redirect('/')->with('success', 'Meme actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meme $meme)
    {
        $this->authorize('delete', $meme);
        $meme->delete();

        return redirect('/')->with('success', 'Meme eliminado.');
    }
}