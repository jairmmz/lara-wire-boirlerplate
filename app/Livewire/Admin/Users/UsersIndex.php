<?php

namespace App\Livewire\Admin\Users;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class UsersIndex extends Component
{
    public function exportExcel()
    {
        return $this->redirectRoute('reports.users.excel');
    }

    public function exportPdf()
    {
        return $this->redirectRoute('reports.users.pdf');
    }

    #[Title('Usuarios')]
    public function render(): View
    {
        return view('livewire.admin.users.users-index');
    }
}
