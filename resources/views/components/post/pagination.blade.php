@props(['posts'])

@if($this->posts->hasPages())
    <x-layouts.container class="relative flex items-center justify-between space-x-4">
        <button
            wire:click="previousPage('page')"
            @if(!$this->posts->onFirstPage()) wire:loading.attr="disabled" @endif
            @disabled($this->posts->onFirstPage())
            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-600 disabled:opacity-20 disabled:hover:bg-primary-700 rounded-full cursor-pointer disabled:cursor-auto h-10 w-10"
        >
            <x-icons.chevron-left class="w-6 h-6"/>
        </button>

        <span class="text-sm text-gray-600 font-medium">
                Page {{ $this->posts->currentPage() }} of {{ $this->posts->lastPage() }}
            </span>

        <button
            wire:click="nextPage('page')"
            @if(!$this->posts->hasMorePages()) wire:loading.attr="disabled" @endif
            @disabled(!$this->posts->hasMorePages())
            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-600 disabled:opacity-20 disabled:hover:bg-primary-700 rounded-full cursor-pointer disabled:cursor-auto h-10 w-10"
        >
            <x-icons.chevron-right class="w-6 h-6"/>
        </button>

        <div wire:loading.flex class="justify-center items-center absolute inset-0 rounded bg-white/95">
            <div class="inline-flex items-center space-x-2 text-gray-600">
                <x-icons.loader class="w-4 h-4 animate-spin"/>
                <span class="text-sm">Loading...</span>
            </div>
        </div>
    </x-layouts.container>
@endif

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.hook('morph.updated', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
@endpush
