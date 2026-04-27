<x-layout>

    {{-- Header / Navigation --}}
    <header class="py-8 md:py-12 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('ticket.index') }}"
                class="inline-flex items-center text-sm text-muted-foreground hover:text-foreground">
                <x-icons.arrow-back class="w-4 h-4 mr-1" />
                Back to Tickets
            </a>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('ticket.edit', $ticket) }}"
                class="inline-flex items-center px-3 py-2 text-sm rounded bg-blue-600 text-white hover:bg-blue-700">
                <x-icons.external class="w-4 h-4 mr-1" />
                Edit Ticket
            </a>

            {{-- Delete --}}
            <form method="POST" action="{{ route('ticket.destroy', $ticket) }}"
                onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                @csrf
                @method('DELETE')

                <button type="submit" class="px-3 py-2 text-sm rounded bg-red-600 text-white hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </header>

    {{-- Ticket Details --}}
    <x-card class="mb-10">
        <h1 class="text-3xl font-bold text-foreground">{{ $ticket->title }}</h1>

        <div class="mt-4 flex items-center gap-3">
            <x-ticket.status-label :status="$ticket->status" />
            <x-ticket.priority-label :priority="$ticket->priority" />
        </div>

        @if ($ticket->description)
            <div class="mt-6 text-muted-foreground leading-relaxed">
                {{ $ticket->description }}
            </div>
        @endif

        {{-- Links --}}
        @if (!empty($ticket->links) && count($ticket->links))
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-muted-foreground mb-2">Links</h3>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($ticket->links as $link)
                        <li>
                            <a href="{{ $link }}" target="_blank" class="text-blue-600 hover:underline break-all">
                                {{ $link }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Image --}}
        @if ($ticket->image_path)
            <div class="mt-6">
                <img src="{{ asset('storage/' . $ticket->image_path) }}" alt="Ticket Image" class="rounded-lg border">
            </div>
        @endif

        <div class="mt-6 text-xs text-muted-foreground">
            Created {{ $ticket->created_at->diffForHumans() }}
            @if ($ticket->updated_at->ne($ticket->created_at))
                • Updated {{ $ticket->updated_at->diffForHumans() }}
            @endif
        </div>
    </x-card>

    {{-- Notes Section --}}
    <section>
        <h2 class="text-xl font-semibold mb-4">Notes</h2>

        @forelse ($ticket->notes as $note)
            <x-card class="mb-4">
                <div class="text-sm text-foreground">
                    {{ $note->body }}
                </div>

                <div class="mt-3 text-xs text-muted-foreground">
                    {{ $note->created_at->diffForHumans() }}
                </div>
            </x-card>
        @empty
            <x-card>
                <p class="text-sm text-muted-foreground">No notes yet.</p>
            </x-card>
        @endforelse
    </section>

</x-layout>