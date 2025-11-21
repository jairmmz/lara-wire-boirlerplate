<?php

namespace App\Livewire\Admin\RolesPermissions;

use Livewire\Attributes\Title;
use Livewire\Component;

class RolePermisssionsCreate extends Component
{
    #[Title('Crear Rol')]
    public function render()
    {
        return view('livewire.admin.roles-permissions.role-permisssions-create');
    }
}
