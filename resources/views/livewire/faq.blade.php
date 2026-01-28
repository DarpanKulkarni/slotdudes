<div class="space-y-8">
    <div class="prose prose-lg">
        <h2 class="text-black dark:text-white">Frequently Asked Questions</h2>
    </div>

    <div class="w-full border-y border-gray-200 dark:border-gray-700 divide-y divide-gray-200 dark:divide-gray-700">
        @foreach ($faqs as $faq)
            <div x-data="{ expanded: false }" class="w-full">
                <button
                    type="button"
                    @click="expanded = !expanded"
                    class="flex w-full items-center justify-between py-2 text-left focus:outline-none group"
                    :class="expanded ? 'text-primary-600 dark:text-primary-500' : 'text-gray-900 dark:text-white'"
                >
                    <span class="text-lg font-medium leading-7 flex items-center min-h-21 md:min-h-0 md:py-2">
                        {{ $faq->question }}
                    </span>
                    <span class="ml-6 flex items-center">
                        <svg x-show="!expanded" class="h-6 w-6 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                        <svg x-show="expanded" x-cloak class="h-6 w-6 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                        </svg>
                    </span>
                </button>
                <div x-show="expanded" x-collapse x-cloak class="pb-4">
                    <div class="text-base leading-7 text-gray-600 dark:text-gray-400 prose dark:prose-invert max-w-none">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
