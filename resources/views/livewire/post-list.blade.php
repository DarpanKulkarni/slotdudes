<section class="py-10 space-y-12">
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
