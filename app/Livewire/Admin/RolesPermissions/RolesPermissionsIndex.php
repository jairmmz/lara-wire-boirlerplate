<?php

namespace App\Livewire\Admin\RolesPermissions;

use Livewire\Attributes\Title;
use Livewire\Component;

class RolesPermissionsIndex extends Component
{
    #[Title('Roles y Permisos')]
    public function render()
    {
        return view('livewire.admin.roles-permissions.roles-permissions-index');
    }
}
