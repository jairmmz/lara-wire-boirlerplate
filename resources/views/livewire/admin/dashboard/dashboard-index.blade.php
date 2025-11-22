<div>
    <flux:heading size="lg" level="1" class="mb-2">
        Panel Principal
    </flux:heading>

    <flux:separator class="mb-4" variant="subtitle" />

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-6">
        @foreach ($this->stats as $stat)
            <div class="rounded-lg px-6 py-4 bg-zinc-50 dark:bg-zinc-700">
                <flux:subheading>{{ $stat['title'] }}</flux:subheading>
                <flux:heading size="xl" class="mb-2">{{ $stat['value'] }}</flux:heading>
                <div class="flex items-center gap-1 font-medium text-sm @if ($stat['trendUp']) @else text-red-500 dark:text-red-400 @endif">
                    <flux:icon :icon="$stat['trendUp'] ? 'arrow-trending-up' : 'arrow-trending-down'" variant="micro" /> {{ $stat['trend'] }}
                </div>
            </div>
        @endforeach
    </div>
</div>
