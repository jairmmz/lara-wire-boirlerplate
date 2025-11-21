<flux:card class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="lg" level="1" class="mb-2">
            Crear Rol
        </flux:heading>
        <flux:button icon="arrow-left" size="sm" variant="primary" href="{{ route('admin.roles.index') }}" wire:navigate>
            Regresar
        </flux:button>
    </div>

    <flux:separator class="mb-4" variant="subtitle" />

    <form wire:submit="submit" class="space-y-6" autocomplete="off">
        <div class="grid grid-cols-1 gap-4">
            {{-- Nombre del Rol --}}
            <flux:input
                size="sm"
                label="Nombre del Rol"
                badge="requerido"
                wire:model="form.name"
                clearable
                autofocus

                placeholder="Administrador, Supervisor, Asistence, etc."
            />

            {{-- Permisos --}}
            <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100">Permisos Disponibles</h3>

            <div x-data="{
                selectedPermissions: @entangle('form.selectedPermissions'),

                toggleGroup(permissionsIds) {
                    const allSelected = this.isGroupSelected(permissionsIds);
                    permissionsIds.forEach(id => {
                        if (allSelected) {
                            this.selectedPermissions = this.selectedPermissions.filter(p => p !== id);
                        } else {
                            if (!this.selectedPermissions.includes(id)) {
                                this.selectedPermissions.push(id);
                            }
                        }
                    });
                },

                togglePermission(id) {
                    if (this.selectedPermissions.includes(id)) {
                        this.selectedPermissions = this.selectedPermissions.filter(p => p !== id);
                    } else {
                        this.selectedPermissions.push(id);
                    }
                },

                isGroupSelected(permissions) {
                    return permissions.every(id => this.selectedPermissions.includes(id));
                },

                isSelected(id) {
                    return this.selectedPermissions.includes(id);
                },
            }">
                @foreach ($groupedPermissions as $group => $permissions)
                    <div class="mb-4 border rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-3">
                            <input
                                type="checkbox"
                                :checked="isGroupSelected({{ $permissions->pluck('id') }})"
                                @click="toggleGroup({{ $permissions->pluck('id') }})"
                                class="rounded border-gray-300"
                            >
                            <span class="font-semibold capitalize">{{ $group }}</span>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 ml-6">
                            @foreach ($permissions as $permission)
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input
                                        type="checkbox"
                                        :checked="isSelected({{ $permission->id }})"
                                        @click="togglePermission({{ $permission->id }})"
                                        class="rounded border-gray-300"
                                    >
                                    <span class="text-sm">
                                        {{ $permission->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            @error('form.selectedPermissions')
                <span class="text-sm font-medium text-red-500 dark:text-red-400">
                    <flux:icon icon="exclamation-triangle" variant="mini" class="inline" />
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="flex">
            <flux:spacer />
            <flux:button icon="bookmark" size="sm" type="submit" variant="primary">Guardar</flux:button>
        </div>
    </form>
</flux:card>
