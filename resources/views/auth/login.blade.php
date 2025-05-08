<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

      <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <div class="mt-1 relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Password') }}</label>
                <div class="mt-1 relative">
                    <input id="password" type="password" name="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">{{ __('Forgot password?') }}</a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
</x-guest-layout>
