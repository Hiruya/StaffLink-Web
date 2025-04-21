<x-layouts.app.sidebar :title="$title ?? null">
    <main class="p-4"> {{-- optional class styling --}}
        {{ $slot }}
        @stack('scripts')
    </main>
</x-layouts.app.sidebar>