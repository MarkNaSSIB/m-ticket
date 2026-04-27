<x-layout>

    <div class="text-center mt-20">
        <h1 class="text-5xl font-bold mb-6">Welcome to M-Ticket</h1>
        <p class="text-lg text-gray-400 mb-8">Your one-stop solution for efficient ticket management.</p>
        @guest
            <a href="/login" class="btn btn-lg">Get Started</a>
        @endguest

        @auth
            <a href="/tickets" class="btn btn-lg">See Tickets</a>
        @endauth
 
    </div>

</x-layout>