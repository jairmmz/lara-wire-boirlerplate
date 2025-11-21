<?php

namespace App\Livewire\Admin\RolesPermissions;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesPermisssionsTable extends Component
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

    public function editRole(int $id): void
    {
        $this->dispatch('edit-role', $id);
    }

    public function deleteRole(int $id): void
    {
        $this->dispatch(
            'show-confirmation',
            [
                'title' => 'Eliminar rol',
                'message' => '¿Estás seguro de eliminar este rol?',
                'event' => 'confirm-delete-role',
                'id' => $id
            ]
        );
    }

    #[On('confirm-delete-role')]
    public function confirmDeleteRole(int $id): void
    {
        Role::find($id)?->delete();

        session()->flash('success', 'rol eliminado correctamente');
    }

    #[Computed()]
    public function roles(): LengthAwarePaginator
    {
        return Role::with('permissions')
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.admin.roles-permissions.roles-permisssions-table');
    }
}
