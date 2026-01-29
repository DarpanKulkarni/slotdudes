<div class="space-y-8">
    {{--<div class="prose prose-lg">
        <h2 class="text-black">Frequently Asked Questions</h2>
    </div>--}}

    <div class="w-full border-y border-gray-200 divide-y divide-gray-200" x-data="{ activeAccordion: null }">
        @foreach ($faqs as $faq)
            <div class="w-full">
                <button
                    type="button"
                    @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}"
                    class="flex w-full items-center justify-between py-2 lg:py-4 text-left focus:outline-none group text-gray-900"
                    :class="{ '!text-primary-600': activeAccordion === {{ $faq->id }} }"
                >
                    <span class="text-lg font-medium leading-7 flex items-center min-h-[5.25rem] md:min-h-0">
                        {{ $faq->question }}
                    </span>
                    <span class="ml-6 flex items-center">
                        <svg
                            class="h-6 w-6 transform transition-transform duration-300"
                            :class="{ 'rotate-180': activeAccordion === {{ $faq->id }} }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </span>
                </button>
                <div
                    x-show="activeAccordion === {{ $faq->id }}"
                    x-collapse.duration.300ms
                    x-cloak
                >
                    <div class="pb-4 text-base leading-7 text-gray-600 prose max-w-none">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
