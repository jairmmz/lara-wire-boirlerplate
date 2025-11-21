<flux:card class="space-y-6">
    <div class="flex items-center justify-between">
        <flux:heading size="lg" level="1" class="mb-2">
            Crear Usuario
        </flux:heading>
        <flux:button icon="arrow-left" size="sm" variant="primary" href="{{ route('admin.users.index') }}" wire:navigate>
            Regresar
        </flux:button>
    </div>

    <flux:separator class="mb-4" variant="subtitle" />

    <form wire:submit="submit" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Nombres y apellidos --}}
            <flux:input
                size="sm"
                label="Nombres y apellidos"
                badge="requerido"
                wire:model="form.name"
                autocomplete="name"
                clearable
                autofocus
                required
            />

            {{-- Correo  electrónico--}}
            <flux:input
                size="sm"
                label="Correo electrónico"
                badge="requerido"
                type="email"
                wire:model="form.email"
                autocomplete="email"
                clearable
                required
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Contraseña --}}
            <flux:input
                size="sm"
                label="Contraseña"
                badge="requerido"
                type="password"
                wire:model="form.password"
                autocomplete="new-password"
                viewable
            />

            {{-- Confirmar contraseña --}}
            <flux:input
                size="sm"
                label="Confirmar contraseña"
                badge="requerido"
                type="password"
                wire:model="form.password_confirmation"
                autocomplete="new-password"
                viewable
            />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:field variant="inline">
                <flux:label>¿Usuario activo?</flux:label>

                <flux:switch wire:model.live="form.is_active" />

                <flux:error name="form.is_active" />
            </flux:field>

            <flux:pillbox size="sm" wire:model="form.roles" multiple searchable placeholder="Seleccionar roles..." required>
                @foreach ($roles as $role)
                    <flux:pillbox.option value="{{ $role->name }}">{{ $role->name }}</flux:pillbox.option>
                @endforeach
            </flux:pillbox>
        </div>

        <div class="flex">
            <flux:spacer />
            <flux:button icon="bookmark" size="sm" type="submit" variant="primary">Guardar</flux:button>
        </div>
    </form>
</flux:card>
