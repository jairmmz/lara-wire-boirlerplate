<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Forms\Admin\Users\UserForm;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public UserForm $form;

    public Collection $roles;

    public function mount(?User $user = null)
    {
        $this->form->setUser($user);
        $this->roles = Role::select('id', 'name')->where('name', '!=', 'super administrador')->get();
    }

    public function submit(): void
    {
        $this->form->save();

        $this->redirectRoute('admin.users.index', navigate: true);

        Flux::toast('Usuario actualizado con éxito.', variant: 'success');
    }

    #[Title('Editar Usuario')]
    public function render()
    {
        return view('livewire.admin.users.user-form');
    }
}
