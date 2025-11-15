<div>
    <div class="flex items-center justify-between">
        <div>
            <flux:heading size="xl" level="1">
                Usuarios
            </flux:heading>
            <flux:text class="mt-1 mb-4 text-base">Lista de Usuarios</flux:text>
        </div>
        <div class="flex gap-2">
            <flux:button icon="sheet" size="sm" variant="primary" color="green" wire:click="exportExcel">
                Exportar EXCEL
            </flux:button>
            <flux:button icon="file-text" size="sm" variant="primary" color="red" wire:click="exportPdf">
                Exportar PDF
            </flux:button>
            <flux:button icon="plus" size="sm" variant="primary" href="{{ route('admin.users.create') }}">
                Añadir
            </flux:button>
        </div>
    </div>

    <flux:separator class="mb-4" variant="subtitle" />

    <livewire:admin.users.users-table lazy />
</div>
