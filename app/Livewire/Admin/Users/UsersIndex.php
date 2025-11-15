<?php

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\Title;
use Livewire\Component;

class UsersIndex extends Component
{
    #[Title('Usuarios')]
    public function render()
    {
        return view('livewire.admin.users.users-index');
    }
}
