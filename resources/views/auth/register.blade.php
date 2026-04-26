<x-layout>

    <div class="max-w-md mx-auto mt-8 bg-card p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Create an Account</h2>

        <form action="/register" method="POST" class="space-y-4">

            @csrf

            <div>
                <label for="name" class="block text-sm font-medium mb-1">Name</label>
                <input type="text" id="name" name="name" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

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

            <div>
                <label for="password" class="block text-sm font-medium mb-1">Retype Password</label>
                <input type="password" id="repassword" name="repassword" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
            </div>

            <button type="submit" class="w-full btn h-10">Register</button>
        </form>

        <p class="text-center text-sm text-gray-400 mt-4">
            Already have an account? <a href="/login" class="text-primary hover:underline">Sign In</a>
        </p>
    </div>

</x-layout>