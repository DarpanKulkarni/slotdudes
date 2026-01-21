<div>
    @if ($page->is_home_page)
        <livewire:casino-list :page="$page"/>
    @elseif ($page->is_blog_page)
        <livewire:post-list :page="$page"/>
    @else
        <section class="py-8" aria-labelledby="page-title">
            <x-layouts.container class="space-y-8">
                @unless($page->is_home_page)
                    <x-post.title :post="$page" featured="true" tag="h1" :link="false"/>
                @endunless
                <div class="prose prose-xl lg:prose-[23px] max-w-full">
                    {!! $page->content !!}
                </div>
            </x-layouts.container>
        </section>
    @endif
</div>
