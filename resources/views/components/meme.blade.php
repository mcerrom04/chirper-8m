@props(['meme'])

<div class="w-full max-w-2xl mx-auto perspective mb-6">
    <div x-data="{ flipped: false }" class="relative w-full"
         @click.away="flipped = false">

        {{-- Spacer invisible que mantiene el espacio - usa el contenido más largo --}}
        <div class="invisible" aria-hidden="true">
            <div class="bg-base-100 card shadow-lg">
                <div class="card-body p-4">
                    <div class="flex space-x-3 mb-3">
                        <div class="w-10 h-10 rounded-full"></div>
                        <div class="min-w-0 flex-1">
                            <div class="h-4 mb-2"></div>
                        </div>
                    </div>
                    
                    {{-- Contenido del frente --}}
                    @if($meme->message)
                        <p class="text-base break-words whitespace-pre-wrap mb-3">{{ $meme->message }}</p>
                    @endif
                    @if($meme->image_url)
                        <div class="mb-3 flex justify-center">
                            <img src="{{ $meme->image_url }}" 
                                 alt="" 
                                 class="max-w-full max-h-[500px] object-contain rounded-lg" />
                        </div>
                    @endif
                    
                    {{-- Contenido de atrás (explicación) para comparar tamaño --}}
                    <div class="mb-3">
                        <h3 class="text-xl font-bold mb-4 text-center">Explicación</h3>
                        <p class="text-base break-words whitespace-pre-wrap">{{ $meme->explicacion ?? 'Sin explicación' }}</p>
                    </div>
                    
                    <div class="h-10 pt-3 border-t border-base-300"></div>
                </div>
            </div>
        </div>

        {{-- FRONT Y BACK con position absolute sobre el spacer --}}
        <div class="absolute inset-0 w-full"
             :class="flipped ? 'rotate-y-180' : ''"
             style="transform-style: preserve-3d; transition: transform 0.6s;">

            {{-- FRONT --}}
            <div class="absolute w-full h-full backface-hidden bg-base-100 card shadow-lg">
                <div class="card-body p-4 flex flex-col h-full">
                    <div class="flex space-x-3 mb-3">
                        @if($meme->user)
                            <div class="avatar shrink-0">
                                <div class="w-10 h-10 rounded-full overflow-hidden">
                                    <img src="https://avatars.laravel.cloud/{{ urlencode($meme->user->email) }}"
                                         alt="Avatar de {{ $meme->user->name }}"
                                         class="w-full h-full object-cover" />
                                </div>
                            </div>
                        @else
                            <div class="avatar shrink-0">
                                <div class="w-10 h-10 rounded-full overflow-hidden">
                                    <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                                         alt="Usuario anónimo"
                                         class="w-full h-full object-cover" />
                                </div>
                            </div>
                        @endif

                        <div class="min-w-0 flex-1">
                            <div class="flex justify-between w-full flex-wrap gap-2">
                                <div class="flex items-center gap-1 flex-wrap">
                                    <span class="text-sm font-semibold">{{ $meme->user ? $meme->user->name : 'Anónimo' }}</span>
                                    <span class="text-base-content/60">·</span>
                                    @if ($meme->updated_at->gt($meme->created_at->addSeconds(5)))
                                        <span class="text-sm text-base-content/60">{{ $meme->updated_at->diffForHumans() }}</span>
                                        <span class="text-base-content/60">·</span>
                                        <span class="text-sm text-base-content/60 italic">editado</span>
                                    @else
                                        <span class="text-sm text-base-content/60">{{ $meme->created_at->diffForHumans() }}</span>
                                    @endif
                                </div>

                                @can('update', $meme)
                                    <div class="flex gap-1">
                                        <a href="/memes/{{ $meme->id }}/edit" class="btn btn-ghost btn-xs">Editar</a>

                                        @can('delete', $meme)
                                            <form method="POST" action="/memes/{{ $meme->id }}" onsubmit="return confirm('¿Seguro que quieres eliminar este meme?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-ghost btn-xs text-error">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto">
                        @if($meme->message)
                            <p class="text-base break-words whitespace-pre-wrap mb-3">{{ $meme->message }}</p>
                        @endif

                        @if($meme->image_url)
                            <figure class="mb-3 flex justify-center">
                                <img src="{{ $meme->image_url }}" 
                                     alt="Imagen del meme" 
                                     class="max-w-full max-h-[500px] object-contain rounded-lg" />
                            </figure>
                        @endif
                    </div>

                    <div class="flex justify-center pt-3 border-t border-base-300">
                        <button @click.stop="flipped = !flipped"
                                class="btn btn-sm bg-gray-800 hover:bg-gray-900 text-white border-none">
                            🔄 Girar
                        </button>
                    </div>
                </div>
            </div>

            {{-- BACK --}}
            <div class="absolute w-full h-full backface-hidden rotate-y-180 bg-base-100 card shadow-lg">
                <div class="card-body p-4 flex flex-col h-full">
                    <div class="flex-1 overflow-y-auto">
                        <h3 class="text-xl font-bold mb-4 text-primary text-center">Explicación</h3>
                        <p class="text-base-content text-base break-words whitespace-pre-wrap">{{ $meme->explicacion ?? 'Sin explicación' }}</p>
                    </div>

                    <div class="flex justify-center pt-3 mt-3 border-t border-base-300">
                        <button @click.stop="flipped = !flipped"
                                class="btn btn-sm bg-gray-800 hover:bg-gray-900 text-white border-none">
                            🔄 Girar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Estilos necesarios para el efecto 3D --}}
<style>
.perspective {
    perspective: 1000px;
}
.rotate-y-180 {
    transform: rotateY(180deg);
}
.backface-hidden {
    backface-visibility: hidden;
}
</style>
