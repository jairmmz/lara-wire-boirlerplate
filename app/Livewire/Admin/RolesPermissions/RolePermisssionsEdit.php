<?php

namespace App\Livewire\Admin\RolesPermissions;

use App\Enums\RolesType;
use App\Livewire\Forms\Admin\RolesPermissions\RolePermissionsForm;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermisssionsEdit extends Component
{
    public RolePermissionsForm $form;

    public function mount(?Role $role = null)
    {
        abort_if($role->name === RolesType::SUPER_ADMINISTRADOR->value, 403, 'No tienes permisos para realizar esta acción');

        $this->form->setRole($role);
    }

    public function submit(): void
    {
        $this->form->update();

        $this->redirectRoute('admin.roles.index', navigate: true);

        Flux::toast('Rol actualizado con éxito.', variant: 'success');
    }

    #[Title('Editar Rol')]
    public function render()
    {
        $groupedPermissions = Permission::all()
            ->groupBy(fn($permission) => explode('.', $permission->name)[0]);

        return view('livewire.admin.roles-permissions.role-permisssions-form', [
            'groupedPermissions' => $groupedPermissions,
        ]);
    }
}
