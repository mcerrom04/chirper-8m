<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $memes = [
            [
                'author' => 'Paco',
                'message' => 'Meme del 8M',
                'image_url' => 'https://cataas.com/cat',
                'time' => '5 minutes ago'
            ],
            [
                'author' => 'Pedro',
                'message' => 'Otro meme del 8M',
                'image_url' => 'https://api.memegen.link/images/buzz/memes/memes_everywhere.webp',
                'time' => '10 minutes ago'
            ],
            [
                'author' => 'Jose Antonio',
                'message' => 'Un tercer meme del 8M',
                'image_url' => 'https://cataas.com/cat',
                'time' => '15 minutes ago'
            ]
        ];
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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}