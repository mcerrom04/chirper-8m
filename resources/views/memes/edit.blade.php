<x-layout>
    <x-slot:title>
        Editar Meme
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-xl mt-1 font-bold">Editar Meme</h1>

        <div class="card bg-base-100 mt-8">
            <div class="card-body">
                <form method="POST" action="/memes/{{ $meme->id }}">
                    @csrf
                    @method('PUT')

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Mensaje del meme/bulo (opcional si pones imagen)</span>
                        </label>
                        <textarea
                            name="message"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="3"
                            maxlength="255"
                        >{{ old('message', $meme->message) }}</textarea>

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
                        <input type="url" name="image_url" placeholder="https://ejemplo.com/imagen.jpg" value="{{ old('image_url', $meme->image_url) }}" class="input input-bordered w-full @error('image_url') input-error @enderror">
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
                        >{{ old('explicacion', $meme->explicacion) }}</textarea>

                        @error('explicacion')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="card-actions justify-between mt-4">
                        <a href="/" class="btn btn-ghost btn-sm">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
