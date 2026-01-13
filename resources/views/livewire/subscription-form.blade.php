<div class="w-full max-w-md mx-auto">
    @if($isSubscribed)
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">Please check your email to confirm your subscription.</span>
        </div>
    @else
        <form wire:submit.prevent="subscribe" class="flex flex-col sm:flex-row gap-2 items-center">
            <div class="w-full">
                <input
                    wire:model="email"
                    type="email"
                    placeholder="Enter your email"
                    class="w-full px-4 h-12 rounded-full text-gray-900 bg-white border-none focus:ring-2 focus:ring-secondary-500"
                    required
                >
                @error('email') <span class="text-red-300 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <x-button-link
                tag="button"
                type="submit"
                variant="white"
                class="w-full sm:w-auto whitespace-nowrap h-12 py-0!"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove wire:target="subscribe">Subscribe</span>
                <span wire:loading wire:target="subscribe">Please wait...</span>
            </x-button-link>
        </form>
    @endif
</div>
