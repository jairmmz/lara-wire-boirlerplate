<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UsersTable extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public $sortBy = 'id';

    public $sortDirection = 'asc';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function sort(string $column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    public function placeholder(): View
    {
        return view('components.spinner');
    }

    public function deleteUser(int $id): void
    {
        $this->dispatch(
            'show-confirmation',
            [
                'title' => 'Eliminar Usuario',
                'message' => '¿Estás seguro de eliminar este usuario?',
                'event' => 'confirm-delete-user',
                'id' => $id
            ]
        );
    }

    #[On('confirm-delete-user')]
    public function confirmDeleteUser(int $id): void
    {
        User::find($id)?->delete();

        session()->flash('success', 'Usuario eliminado correctamente');
    }

    #[Computed()]
    public function users(): LengthAwarePaginator
    {
        return User::search($this->search)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render(): View
    {
        return view('livewire.admin.users.users-table');
    }
}
