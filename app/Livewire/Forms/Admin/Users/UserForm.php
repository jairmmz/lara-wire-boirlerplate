<?php

namespace App\Livewire\Forms\Admin\Users;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public bool $is_active = true;

    public array $roles = [];

    public function rulesCreate(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6|same:password',
            'is_active' => 'boolean',
            'roles' => 'array',
            'roles.*' => 'required|string|exists:roles,name',
        ];
    }

    public function rulesUpdate(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => 'nullable|string|min:6',
            'password_confirmation' => 'nullable|string|min:6|same:password',
            'roles' => 'array',
            'roles.*' => 'required|string|exists:roles,name',
        ];
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->is_active = $user->is_active;
        $this->roles = $user->roles->pluck('name')->toArray();
    }

    public function save(): void
    {
        if ($this->user) {
            $this->update();
        } else {
            $this->create();
        }
    }

    public function create()
    {
        $this->validate($this->rulesCreate());

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'is_active' => $this->is_active
        ]);

        $user->assignRole($this->roles);
    }

    public function update()
    {
        $this->validate($this->rulesUpdate());

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'is_active' => $this->is_active
        ]);

        $this->user->syncRoles($this->roles);
    }
}
