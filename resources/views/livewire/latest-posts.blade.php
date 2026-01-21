<div class="splide" id="latest-posts-slider">
    <div class="splide__track">
        <ul class="splide__list">
            @foreach($latestItems as $item)
                <li class="splide__slide">
                    <article class="flex flex-col lg:flex-row items-center gap-6">
                        <div class="w-full lg:w-[320px] shrink-0">
                            <a href="{{ $item['url'] }}" class="block overflow-hidden rounded-lg">
                                <img src="{{ $item['image_url'] }}" alt="{{ $item['title'] }}" class="w-full h-auto object-cover aspect-video hover:scale-105 transition-transform duration-300">
                            </a>
                        </div>
                        <div class="w-full space-y-4 text-left">
                            <div class="flex items-center gap-4 text-sm text-primary-200">
                                <span>{{ $item['published_at']->format('M d, Y') }}</span>
                            </div>

                            <h3 class="text-xl font-bold">
                                <a href="{{ $item['url'] }}" class="text-white hover:text-primary-300 transition-colors">
                                    {{ $item['title'] }}
                                </a>
                            </h3>

                            <p class="text-gray-300 line-clamp-3">
                                {{ $item['excerpt'] }}
                            </p>
                        </div>
                    </article>
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Splide('#latest-posts-slider', {
                type: 'loop',
                perPage: 1,
                autoplay: true,
                interval: 3000,
                arrows: true,
                pagination: true,
                gap: '2rem',
                breakpoints: {
                    1024: {
                        arrows: false, // Hide arrows on mobile/tablet
                    }
                }
            }).mount();
        });
    </script>

    <style>
        #latest-posts-slider .splide__pagination {
            bottom: -3.5rem !important;
            gap: 0.5rem !important;
        }

        #latest-posts-slider .splide__pagination__page {
            background: var(--color-primary-400) !important;
            width: 14px !important;
            height: 14px !important;
            opacity: 1 !important;
            transition: all 0.3s ease !important;
            border-radius: 50% !important;
            border: none !important;
        }
        #latest-posts-slider .splide__pagination__page.is-active {
            background: var(--color-primary-100) !important;
            transform: scale(1.2) !important;
        }

        #latest-posts-slider .splide__arrow {
            background: transparent !important;
            width: 3rem !important;
            height: 3rem !important;
            opacity: 0.7 !important;
            transition: opacity 0.3s ease !important;
            border: none !important;
        }
        #latest-posts-slider .splide__arrow:hover {
            background: transparent !important;
            opacity: 1 !important;
        }
        #latest-posts-slider .splide__arrow svg {
            fill: white !important;
            width: 2rem !important;
            height: 2rem !important;
        }

        #latest-posts-slider .splide__arrow--prev {
            left: -4rem !important;
        }
        #latest-posts-slider .splide__arrow--next {
            right: -4rem !important;
        }

        @media (max-width: 1024px) {
            #latest-posts-slider .splide__arrows {
                display: none !important;
            }
            #latest-posts-slider .splide__pagination {
                bottom: -3.5rem !important;
            }
        }
    </style>
</div>
