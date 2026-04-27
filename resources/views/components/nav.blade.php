<nav class="flex justify-between items-center h-20 max-w-7xl mx-auto px-8">
    <div>
        <a href="/">
            <img src="/images/logo.png" width="100" alt="Idea logo">
        </a>
    </div>


    @auth
        <div class="flex gap-x-5 items-center">

            <span>Welcome, {{ auth()->user()->name }}</span>

            <a href="{{ route('ticket.create') }}"
                class="px-3 py-2 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">
                New Ticket
            </a>

            <a href="{{ route('logout') }}" class="btn">
                Logout
            </a>

        </div>
    @endauth



    @guest
        <div class="flex gap-x-5 items-center">
            <a href="/login">Sign In</a>
            <a href="/register" class="btn">Register</a>
        </div>
    @endguest

</nav>