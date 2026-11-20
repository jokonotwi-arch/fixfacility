@props([
    'id' => 'modal',
])

<div x-data="{ open: false }" id="{{ $id }}-wrapper">

    <!-- Trigger slot -->
    @isset($trigger)
    <div @click="open = true">
        {{ $trigger }}
    </div>
    @endisset

    <!-- Modal overlay -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
        style="display: none;"
    >
        <!-- Backdrop -->
        <div
            class="absolute inset-0 bg-black/50 backdrop-blur-sm"
            @click="open = false"
        ></div>

        <!-- Panel -->
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            class="relative bg-white rounded-2xl shadow-xl w-full max-w-lg max-h-[90vh] flex flex-col overflow-hidden z-10"
            @click.stop
        >
            <!-- Header -->
            @isset($header)
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <div class="font-semibold text-slate-800 text-base">{{ $header }}</div>
                <button
                    @click="open = false"
                    class="p-1.5 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors"
                    aria-label="Tutup"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            @endisset

            <!-- Body -->
            @isset($body)
            <div class="flex-1 overflow-y-auto px-6 py-5">
                {{ $body }}
            </div>
            @else
            <div class="flex-1 overflow-y-auto px-6 py-5">
                {{ $slot }}
            </div>
            @endisset

            <!-- Footer -->
            @isset($footer)
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-end gap-3">
                {{ $footer }}
            </div>
            @endisset
        </div>
    </div>
</div>
