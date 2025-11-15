<flux:modal name="modal-confirmation" class="min-w-[22rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $title }}</flux:heading>

            <flux:text class="mt-2">
                {!! nl2br(e($message)) !!}
            </flux:text>
        </div>

        <div class="flex gap-2">
            <flux:spacer />

            <flux:modal.close>
                <flux:button variant="ghost">Cancelar</flux:button>
            </flux:modal.close>

            <flux:button wire:click="confirm" variant="danger">Confirmar</flux:button>
        </div>
    </div>
</flux:modal>
