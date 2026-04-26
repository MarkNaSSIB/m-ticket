<x-layout>
    <div class="max-w-md mx-auto mt-8 bg-card p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Sign In to Your Account</h2>

        <form action="/login" method="POST" class="space-y-4">

            @csrf

            <div>
                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <button type="submit" class="w-full btn h-10">Sign In</button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-4">
            Don't have an account? <a href="/register" class="text-primary hover:underline">Register Now</a>
        </p>
    </div>

</x-layout>