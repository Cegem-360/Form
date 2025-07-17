<x-layouts.app>
    <div
        class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="w-full max-w-md p-8 shadow-2xl bg-white/90 rounded-2xl dark:bg-gray-900/90 backdrop-blur-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <x-application-logo class="w-20 h-20 text-indigo-600 dark:text-pink-500" />
            </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block w-full mt-1 transition-all duration-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-pink-500 dark:focus:border-pink-500"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                        class="block w-full mt-1 transition-all duration-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-pink-500 dark:focus:border-pink-500"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500 dark:bg-gray-900 dark:border-gray-700 dark:focus:ring-pink-500 dark:focus:ring-offset-gray-800"
                            name="remember">
                        <span class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 underline transition dark:text-pink-400 hover:text-indigo-900 dark:hover:text-pink-300"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-center mt-6">
                    <x-primary-button
                        class="w-full py-3 text-lg text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-pink-500 hover:to-indigo-500 rounded-xl">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
