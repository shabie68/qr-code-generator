<x-guest-layout>
    <div class="qr-login-container">

        <x-auth-card>
            <x-slot name="logo">
             
            </x-slot>
            <h1 class="text-center text-2xl font-bold text-gray-800">Login</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                
                {{--
                    <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3">
                        {{ __('Log in') }}
                    </x-button>
                </div>
                --}}
                <div class="mt-4">
                     <x-button class="w-full flex justify-center">
                    {{ __('Log in') }}
                </x-button>
                </div>
                
            </form>

            <div class="mt-4 flex justify-between items-center">
                <span class="bg-gray-500" style="width: 40%; height: 1px; color: green"></span>
                <span >Or</span>
                <span class="bg-gray-500" style="width: 40%; height: 1px; color: green"></span>

            </div>

            <div class="mt-6 flex justify-center space-x-2 text-sm text-gray-600">
                <div>Don't have an account?</div>
                <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Register here
                </a>
            </div>
        </x-auth-card>


    </div>
</x-guest-layout>
