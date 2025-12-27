@props([
    'size' => 'default',
    'variant' => 'primary',
    'tag' => 'a'
])

@php
    $sizeClasses = [
        'sm' => 'px-4 py-2 text-xs',
        'default' => 'px-8 py-4 text-sm',
        'lg' => 'px-8 py-2 text-lg',
        'xl' => 'px-8 md:px-14 py-4 text-lg md:text-2xl'
    ];

    $variantClasses = [
        'white' => 'bg-white hover:bg-gray-100 focus-visible:ring-gray-100 text-black',
        'white-outline' => 'border-1 border-white text-white hover:bg-white hover:text-black focus-visible:ring-gray-100',
        'primary' => 'bg-primary-700 hover:bg-primary-600 focus-visible:ring-primary-600 text-white',
        'primary-outline' => 'border-2 border-primary-500 text-primary-500 hover:bg-primary-500 hover:text-white focus-visible:ring-primary-600',
        'secondary' => 'bg-secondary-500 hover:bg-secondary-600 focus-visible:ring-secondary-600 text-white',
        'secondary-outline' => 'border-2 border-secondary-500 text-secondary-500 hover:bg-secondary-500 hover:text-white focus-visible:ring-secondary-600',
        'accent' => 'bg-accent-500 hover:bg-accent-600 focus-visible:ring-accent-600 text-white',
        'accent-outline' => 'border-2 border-accent-500 text-accent-500 hover:bg-accent-500 hover:text-white focus-visible:ring-accent-600',
        'green' => 'bg-green-500 hover:bg-green-600 focus-visible:ring-green-600 text-white',
        'green-outline' => 'border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white focus-visible:ring-green-600',
    ];

    $baseClasses = 'inline-flex items-center justify-center text-center rounded-full uppercase font-bold focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed';

    $classes = implode(' ', [
        $baseClasses,
        $sizeClasses[$size] ?? $sizeClasses['default'],
        $variantClasses[$variant] ?? $variantClasses['primary']
    ]);
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => $classes]) }}>
{{ $slot }}
</{{ $tag }}>
