<x-layouts.app>
    <div
        class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
        <div class="w-full max-w-md p-8 shadow-2xl bg-white/90 rounded-2xl dark:bg-gray-900/90 backdrop-blur-lg">
            <!-- Logo -->
            <div class="flex justify-center mb-6">
                <x-application-logo class="w-20 h-20 text-indigo-600 dark:text-pink-500" />
            </div>
            <div class="mb-4 text-sm text-center text-gray-600 dark:text-gray-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email"
                        class="block w-full h-12 px-4 mt-1 text-base transition-all duration-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-pink-500 dark:focus:border-pink-500"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-center mt-6">
                    <x-primary-button
                        class="w-full py-3 text-lg text-white transition-all duration-200 shadow-lg bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:from-pink-500 hover:to-indigo-500 rounded-xl">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
