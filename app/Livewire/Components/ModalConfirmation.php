<?php

namespace App\Livewire\Components;

use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalConfirmation extends Component
{
    public string $title = 'Confirmar acción';
    public string $message = '¿Estás seguro de que quieres continuar?';
    public ?string $confirmEvent = null;
    public ?string $id = null;

    #[On('show-confirmation')]
    public function show($params)
    {
        $this->title = $params['title'] ?? $this->title;
        $this->message = $params['message'] ?? $this->message;
        $this->confirmEvent = $params['event'] ?? null;
        $this->id = $params['id'] ?? null;

        Flux::modal('modal-confirmation')->show();
    }

    public function confirm()
    {
        if ($this->confirmEvent) {
            $this->dispatch($this->confirmEvent, $this->id);
        }

        Flux::modal('modal-confirmation')->close();
    }

    public function render()
    {
        return view('livewire.components.modal-confirmation');
    }
}
