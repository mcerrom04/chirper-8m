<x-layout>
    <x-slot:title>
        Inicio
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8 text-purple-700">🎗️ Últimos Memes contra la Violencia de Género</h1>

        <!-- Formulario para crear meme -->
        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <h2 class="card-title text-lg">Publicar nuevo meme/bulo</h2>
                <form method="POST" action="/memes">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Mensaje del meme/bulo (opcional si pones imagen)</span>
                        </label>
                        <textarea
                            name="message"
                            placeholder="Escribe el mensaje del meme o bulo..."
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="3"
                            maxlength="255"
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label">
                            <span class="label-text">URL de la imagen (opcional si pones mensaje)</span>
                        </label>
                        <input type="url" name="image_url" placeholder="https://ejemplo.com/imagen.jpg" value="{{ old('image_url') }}" class="input input-bordered w-full @error('image_url') input-error @enderror">
                        @error('image_url')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="form-control w-full mt-4">
                        <label class="label">
                            <span class="label-text">Explicación que desmiente el meme/bulo *</span>
                        </label>
                        <textarea
                            name="explicacion"
                            placeholder="Explica por qué este meme o bulo es falso o engañoso..."
                            class="textarea textarea-bordered w-full resize-none @error('explicacion') textarea-error @enderror"
                            rows="4"
                            maxlength="1000"
                            required
                        >{{ old('explicacion') }}</textarea>

                        @error('explicacion')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-sm bg-purple-700 hover:bg-purple-800 text-white border-none">Publicar</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="space-y-4 mt-8">
            @forelse ($memes as $meme)
                <x-meme :meme="$meme" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="mt-4 text-base-content/60">No hay memes todavía. ¡Sé el primero en publicar!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>