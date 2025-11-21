<?php

namespace App\Livewire\Admin\Users;

use App\Livewire\Forms\Admin\Users\UserForm;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    public UserForm $form;

    public Collection $roles;

    public function mount()
    {
        $this->roles = Role::select('id', 'name')->where('name', '!=', 'super administrador')->get();
    }

    public function submit(): void
    {
        $this->form->save();

        $this->redirectRoute('admin.users.index', navigate: true);

        Flux::toast('Usuario creado con éxito.', variant: 'success');
    }

    #[Title('Crear Usuario')]
    public function render()
    {
        return view('livewire.admin.users.user-form');
    }
}
