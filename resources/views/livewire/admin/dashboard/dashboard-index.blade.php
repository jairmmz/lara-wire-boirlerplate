<div>
    <flux:heading size="lg" level="1" class="mb-2">
        Panel Principal
    </flux:heading>

    <flux:separator class="mb-4" variant="subtitle" />

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6">
        <div class="rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
            <div class="flex items-center justify-between gap-4">
                <flux:subheading>Total de Usuarios</flux:subheading>
                <flux:button size="sm" icon="arrow-right" href="{{ route('admin.users.index') }}" class="h-4" wire:navigate />
            </div>
            <flux:heading size="xl" class="mb-2">{{ $this->totalUsers }}</flux:heading>
        </div>

        <div class="rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
            <div class="flex items-center justify-between gap-4">
                <flux:subheading>Total de Roles</flux:subheading>
                <flux:button size="sm" icon="arrow-right" href="{{ route('admin.roles.index') }}" class="h-4" wire:navigate />
            </div>
            <flux:heading size="xl" class="mb-2">{{ $this->totalRoles }}</flux:heading>
        </div>

        <div class="rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
            <div class="flex items-center justify-between gap-4">
                <flux:subheading>Total de Permisos</flux:subheading>
                <flux:button size="sm" icon="arrow-right" href="{{ route('admin.roles.index') }}" class="h-4" wire:navigate />
            </div>
            <flux:heading size="xl" class="mb-2">{{ $this->totalPermissions }}</flux:heading>
        </div>
    </div>
</div>
