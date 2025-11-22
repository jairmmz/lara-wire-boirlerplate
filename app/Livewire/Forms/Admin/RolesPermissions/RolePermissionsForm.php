<?php

namespace App\Livewire\Forms\Admin\RolesPermissions;

use App\Enums\RolesType;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionsForm extends Form
{
    public ?Role $role = null;

    public string $name = '';

    public array $selectedPermissions = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($this->role->id ?? null)],
            'selectedPermissions' => 'required|array|min:1',
            'selectedPermissions.*' => 'integer|exists:permissions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'selectedPermissions.required' => 'Debe seleccionar al menos un permiso.',
            'selectedPermissions.min' => 'Debe seleccionar al menos un permiso.',
        ];
    }

    public function setRole(Role $role): void
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function save(): void
    {
        $this->validate();

        DB::transaction(function (): void {
            $role = Role::create([
                'name' => $this->name,
            ]);

            $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();
            $role->syncPermissions($permissions);
        });
    }

    public function update(): void
    {
        $this->validate();

        if ($this->role->name === RolesType::SUPER_ADMINISTRADOR->value) {
            abort(403, 'No tienes permisos para editar este rol');
        }

        $this->role->update([
            'name' => $this->name,
        ]);

        $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();
        $this->role->syncPermissions($permissions);
    }
}
