<x-layout>
    <header class="py-8 md:py-12">
        <h1 class="text-3xl font-bold">Tickets</h1>
        <p class="text-muted-foreground text-sm mt-2">Track issues. Stay organized.</p>
    </header>

    <div class="text-muted-foreground">
        {{-- Filter Bar --}}
        <div class="flex flex-wrap items-center gap-3 mb-8">

            {{-- Status Filters --}}
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold text-muted-foreground">Status:</span>

                @foreach (['open', 'in_progress', 'resolved'] as $status)
                            <a href="{{ route('ticket.index', array_merge(request()->query(), ['status' => $status])) }}" class="px-2 py-1 text-xs rounded border 
                                {{ request('status') === $status
                    ? 'bg-blue-600 text-white border-blue-600'
                    : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}">
                                {{ \App\TicketStatus::from($status)->label() }}
                            </a>
                @endforeach

                {{-- Clear Status Filter --}}
                @if(request('status'))
                    <a href="{{ route('ticket.index', request()->except('status')) }}"
                        class="text-xs text-red-600 underline ml-2">
                        Clear
                    </a>
                @endif
            </div>

            {{-- Priority Filters --}}
            <div class="flex items-center gap-2 ml-6">
                <span class="text-sm font-semibold text-muted-foreground">Priority:</span>

                @foreach (['low', 'medium', 'high'] as $priority)
                            <a href="{{ route('ticket.index', array_merge(request()->query(), ['priority' => $priority])) }}" class="px-2 py-1 text-xs rounded border 
                                {{ request('priority') === $priority
                    ? 'bg-green-600 text-white border-green-600'
                    : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100' }}">
                                {{ \App\TicketPrio::from($priority)->label() }}
                            </a>
                @endforeach

                {{-- Clear Priority Filter --}}
                @if(request('priority'))
                    <a href="{{ route('ticket.index', request()->except('priority')) }}"
                        class="text-xs text-red-600 underline ml-2">
                        Clear
                    </a>
                @endif
            </div>

        </div>


        <div class="grid md:grid-cols-2 gap-6">
            @forelse($tickets as $ticket)
                <x-card href="{{ route('ticket.show', $ticket) }}">
                    <h3 class="text-foreground text-lg font-semibold">
                        {{ $ticket->title }}
                    </h3>

                    <div class="mt-2 flex items-center gap-2">
                        <x-ticket.status-label :status="$ticket->status" />
                        <x-ticket.priority-label :priority="$ticket->priority" />
                    </div>

                    @if ($ticket->description)
                        <div class="mt-5 line-clamp-3">
                            {{ $ticket->description }}
                        </div>
                    @endif

                    <div class="mt-4 text-sm">
                        {{ $ticket->created_at->diffForHumans() }}
                    </div>
                </x-card>
            @empty
                <x-card>
                    <p>No tickets at this time. :)</p>
                </x-card>
            @endforelse
        </div>
    </div>
</x-layout>