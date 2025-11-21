<?php

namespace App\Livewire\Admin\RolesPermissions;

use App\Livewire\Forms\Admin\RolesPermissions\RolePermissionsForm;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class RolePermisssionsCreate extends Component
{
    public RolePermissionsForm $form;

    public function submit(): void
    {
        $this->form->save();

        $this->redirectRoute('admin.roles.index', navigate: true);

        Flux::toast('Rol creado con éxito.', variant: 'success');
    }

    #[Title('Crear Rol')]
    public function render()
    {
        $groupedPermissions = Permission::all()
            ->groupBy(fn ($permission) => explode('.', $permission->name)[0]);

        return view('livewire.admin.roles-permissions.role-permisssions-form', [
            'groupedPermissions' => $groupedPermissions,
        ]);
    }
}
