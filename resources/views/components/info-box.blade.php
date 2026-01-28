@props([
    'backgroundImage',
    'title',
    'description',
    'route'
])

<div {{ $attributes->merge(['class' => 'flex flex-col justify-center items-start rounded-lg bg-cover bg-center w-full md:w-1/2 p-12 text-white']) }} style="background-image: url('{{ $backgroundImage }}')">
    <h2 class="text-3xl font-bold mb-8">{{ $title }}</h2>
    <p class="mb-12">{{ $description }}</p>
    <x-button-link href="{{ $route }}" variant="transparent">Explore Now</x-button-link>
</div>
