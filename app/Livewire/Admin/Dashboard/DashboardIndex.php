<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardIndex extends Component
{
    #[Computed]
    public function totalUsers()
    {
        return User::count();
    }

    #[Computed]
    public function totalRoles()
    {
        return Role::count();
    }

    #[Computed]
    public function totalPermissions()
    {
        return Permission::count();
    }

    #[Title('Panel')]
    public function render()
    {
        return view('livewire.admin.dashboard.dashboard-index');
    }
}
