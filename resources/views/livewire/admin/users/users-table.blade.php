<div class="w-full">
    <div class="mb-3 flex flex-col md:flex-row md:justify-between gap-2">
        <div class="flex w-full md:w-auto justify-center md:justify-start items-center gap-x-3">
            <span class="text-sm text-gray-500 dark:text-gray-400">Mostrar</span>
            <div class="w-20">
                <flux:select size="sm" wire:model.live="perPage">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </flux:select>
            </div>
            <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">Elementos por página</span>
        </div>

        <div class="w-full md:w-[350px]">
            <flux:input size="sm" icon="magnifying-glass" wire:model.live.debounce.300ms="search" placeholder="Buscar" clearable />
        </div>
    </div>

    @if ($this->users->isNotEmpty())
        <flux:table>
            <flux:table.columns>
                <flux:table.column sortable :sorted="$sortBy === 'id'" :direction="$sortDirection" wire:click="sort('id')">ID</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection" wire:click="sort('name')">Nombre</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'email'" :direction="$sortDirection" wire:click="sort('email')">Correo Electrónico</flux:table.column>
                <flux:table.column>Roles</flux:table.column>
                <flux:table.column>Estado</flux:table.column>
                <flux:table.column></flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($this->users as $user)
                    <flux:table.row>
                        <flux:table.cell>#{{ $user->id }}</flux:table.cell>
                        <flux:table.cell>{{ $user->name }}</flux:table.cell>
                        <flux:table.cell>{{ $user->email }}</flux:table.cell>
                        <flux:table.cell>
                            <div class="max-w-5xl flex flex-wrap gap-1">
                                @foreach ($user->roles as $role)
                                    <flux:badge size="sm">{{ $role->name }}</flux:badge>
                                @endforeach
                            </div>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge class="cursor-pointer" size="sm"
                                color="{{ $user->is_active ? 'lime' : 'red' }}">
                                <span class="text-shadow-accent">{{ $user->is_active ? 'Activo' : 'Inactivo' }}</span>
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            @if(!$user->isProtected())
                                <flux:dropdown position="bottom" align="end" offset="-15">
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" inset="top bottom"></flux:button>
                                    <flux:menu>
                                        <flux:menu.item icon="receipt-refund" href="{{ route('admin.users.edit', $user->id) }}" wire:navigate>Editar</flux:menu.item>
                                        <flux:menu.item icon="archive-box" variant="danger" wire:click="deleteUser({{ $user->id }})">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            @endif
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>

        <flux:pagination :paginator="$this->users" />
    @else
        <div class="flex items-center justify-center h-64 mt-4">
            <p class="text-gray-500 dark:text-gray-400">
                @if ($search)
                    <span>No se encontraron usurios para su búsqueda. Pruebe diferentes palabras clave.</span>
                @else
                    <span>No hay usurios disponibles. ¡Crea tu primer usurio!</span>
                @endif
            </p>
        </div>
    @endif
</div>
