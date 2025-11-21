<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>

    <livewire:components.modal-confirmation />
</x-layouts.app.sidebar>
