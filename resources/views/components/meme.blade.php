@props(['meme'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            @if($meme->user)
                <div class="avatar">
                    <div class="w-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/{{ urlencode($meme->user->email) }}"
                             alt="Avatar de {{ $meme->user->name }}"
                             class="rounded-full" />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="w-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                             alt="Usuario anónimo"
                             class="rounded-full" />
                    </div>
                </div>
            @endif

            <div class="min-w-0">
                <div class="flex items-center gap-1">
                    <span class="text-sm font-semibold">{{ $meme->user ? $meme->user->name : 'Anónimo' }}</span>
                    <span class="text-base-content/60">·</span>
                    <span class="text-sm text-base-content/60">{{ $meme->created_at->diffForHumans() }}</span>
                </div>

                <p class="mt-2">{{ $meme->message }}</p>

                @if($meme->image_url)
                    <figure class="mt-3">
                        <img src="{{ $meme->image_url }}" alt="Meme image" class="w-full h-64 object-cover rounded" />
                    </figure>
                @endif
            </div>
        </div>
    </div>
</div>
