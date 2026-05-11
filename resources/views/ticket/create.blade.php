<x-layout>

    <header class="py-8 md:py-12">
        <h1 class="text-3xl font-bold">Create Ticket</h1>
        <p class="text-muted-foreground text-sm mt-2">Open a new ticket to track an issue or request.</p>
    </header>

    <x-card class="max-w-xl">

        <form 
            method="POST" 
            action="{{ route('ticket.store') }}" 
            enctype="multipart/form-data"
            class="space-y-6"
        >
            @csrf

            {{-- Title --}}
            <div>
                <label class="block text-sm font-medium mb-1">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    class="w-full border rounded px-3 py-2"
                    required
                >
            </div>

            {{-- Description (optional) --}}
            <div>
                <label class="block text-sm font-medium mb-1">Description (optional)</label>
                <textarea 
                    name="description" 
                    rows="4"
                    class="w-full border rounded px-3 py-2"
                ></textarea>
            </div>

            {{-- Priority --}}
            <div>
                <label class="block text-sm font-medium mb-1">Priority</label>
                <select 
                    name="priority" 
                    class="w-full border rounded px-3 py-2"
                    required
                >
                    <option value="low">Low</option>
                    <option value="medium" selected>Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select 
                    name="status" 
                    class="w-full border rounded px-3 py-2"
                    required
                >
                    <option value="open" selected>Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="resolved">Resolved</option>
                </select>
            </div>

            {{-- Image (optional) --}}
            <div>
                <label class="block text-sm font-medium mb-1">Image (optional)</label>
                <input 
                    type="file" 
                    name="image" 
                    class="w-full border rounded px-3 py-2"
                    accept="image/*"
                >
            </div>

            {{-- Submit --}}
            <div class="pt-4">
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                >
                    Create Ticket
                </button>
            </div>

        </form>

    </x-card>

</x-layout>
