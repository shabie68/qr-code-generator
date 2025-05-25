<x-guest-layout>
    <x-auth-card>
        <h1 class="text-2xl font-bold text-gray-800 text-center">Register</h1>
        <x-slot name="logo">
            
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-button class="w-full flex justify-center">
                    {{ __('Register') }}
                </x-button>
            </div>

            <div class="mt-4 flex justify-between items-center">
                <span class="bg-gray-500" style="width: 40%; height: 2px; color: green"></span>
                <span >Or</span>
                <span class="bg-gray-500" style="width: 40%; height: 2px; color: green"></span>
            </div>

            <div class="mt-6 flex justify-center space-x-2 text-sm text-gray-600">
                <div>Already have account?</div>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    Login here
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
