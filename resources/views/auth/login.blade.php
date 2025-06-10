<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.10.2/lottie.min.js"></script>

</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Login </h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 bg-green-100 p-3 rounded">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me + Forgot Password -->
            <div class="flex items-center justify-between mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Submit -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Log in
                </button>
            </div>
        </form>

        <!-- Register Redirect -->
        @if (Route::has('register'))
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    Belum Punya Akun?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
                </p>
            </div>
        @endif
    </div>

</body>
</html>
