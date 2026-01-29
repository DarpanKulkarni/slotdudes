@props([
    'backgroundImage',
    'title',
    'description',
    'route',
    'buttonLabel' => 'Explore Now'
])

<div {{ $attributes->merge(['class' => 'flex flex-col justify-center items-start rounded-lg bg-cover bg-center w-full p-8 text-white']) }} style="background-image: url('{{ $backgroundImage }}')">
    <h2 class="text-3xl font-bold mb-6">{{ $title }}</h2>
    <p class="mb-12">{{ $description }}</p>
    <x-button-link href="{{ $route }}" variant="transparent">{{ $buttonLabel }}</x-button-link>
</div>
