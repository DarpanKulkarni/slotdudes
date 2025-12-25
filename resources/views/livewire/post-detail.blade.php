<section class="py-8" aria-labelledby="page-title">
    <x-layouts.container class="space-y-8">
        <div class="space-y-4">
            <x-post.meta :post="$post"/>
            <x-post.title :post="$post" tag="h1" :link="false"/>
        </div>
        <x-post.featured-image :post="$post" :featured="true" :link="false" :full="true"/>
        <div class="prose prose-xl lg:prose-[23px] max-w-full">
            {!! $post->content !!}
        </div>
    </x-layouts.container>
</section>
