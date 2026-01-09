<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        @foreach ($memes as $meme)
        <div class="card bg-base-100 shadow mt-8">
            <figure>
                <img src="{{ $meme['image_url'] }}" alt="Meme" class="w-full h-64 object-cover" />
            </figure>
            <div class="card-body">
                <div>
                    <div class="font-semibold">{{ $meme['author'] }}</div>
                    <div class="mt-1">{{ $meme['message'] }}</div>
                    <div class="text-sm text-gray-500 mt-2">{{ $meme['time'] }}</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-layout>