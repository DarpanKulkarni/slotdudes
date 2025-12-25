<section class="py-10 space-y-10">
    <x-layouts.container>
        <div class="flex flex-col lg:flex-row lg:items-center items-center lg:justify-between text-center lg:text-start text-sm bg-gray-100 rounded space-y-1 lg:space-y-0 py-2 px-3">
            <p>Showing posts with category <strong>"{{ $this->category->name }}"</strong></p>
            <a href="{{ route('posts.list') }}" class="text-primary-500 hover:text-primary-600 underline transition duration-300">Show all</a>
        </div>
    </x-layouts.container>

    <x-layouts.container class="space-y-12">
        @forelse($this->posts as $post)
            <article class="flex flex-col lg:flex-row items-center gap-6">
                <div class="w-full lg:w-[320px] shrink-0">
                    <x-post.featured-image :post="$post"/>
                </div>
                <div class="w-full space-y-4">
                    <x-post.meta :post="$post"/>
                    <x-post.title :post="$post"/>
                    <x-post.excerpt :content="$post->excerpt"/>
                    <x-button-link href="{{ route('posts.detail', $post->slug) }}" class="mt-2">Read More</x-button-link>
                </div>
            </article>
        @empty
            <x-empty>No posts found.</x-empty>
        @endforelse
    </x-layouts.container>

    <x-post.pagination :posts="$this->posts"/>
</section>
