@once
    <div x-data="cookieConsent" x-show="show" x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/90">
        <div class="w-full max-w-lg p-6 mx-4 bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700">
            <h5 class="text-2xl font-semibold text-gray-900 dark:text-white">Cookie Consent</h5>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                This website uses cookies to ensure you get the best experience. Here are the details of the cookies we use:
            </p>
            <div class="mt-4 space-y-2">
                <div class="space-y-1 p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                    <h6 class="text-base font-semibold text-gray-900 dark:text-white">Essential Cookies</h6>
                    <p class="text-sm text-gray-600 dark:text-gray-400">These cookies are necessary for the website to function and cannot be switched off in our systems.</p>
                </div>
                <div class="space-y-1 p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                    <h6 class="text-base font-semibold text-gray-900 dark:text-white">Analytics Cookies</h6>
                    <p class="text-sm text-gray-600 dark:text-gray-400">These cookies allow us to count visits and traffic sources so we can measure and improve the performance of our site.</p>
                </div>
                <div class="space-y-1 p-3 bg-gray-100 rounded-lg dark:bg-gray-700">
                    <h6 class="text-base font-semibold text-gray-900 dark:text-white">Marketing Cookies</h6>
                    <p class="text-sm text-gray-600 dark:text-gray-400">These cookies may be set through our site by our advertising partners to build a profile of your interests and show you relevant adverts on other sites.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-6">
                <x-button-link @click="accept" tag="button">Accept</x-button-link>
                <x-button-link @click="reject" tag="button" variant="secondary">Deny</x-button-link>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cookieConsent', () => ({
                show: false,
                init() {
                    this.show = !localStorage.getItem('cookie_consent');
                },
                accept() {
                    localStorage.setItem('cookie_consent', 'accepted');
                    this.show = false;
                },
                reject() {
                    localStorage.setItem('cookie_consent', 'rejected');
                    this.show = false;
                }
            }));
        });
    </script>
@endonce
