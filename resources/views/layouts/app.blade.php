<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ mix('js/app.js') }}" defer></script>
        <style>
            .qr-logout {
                text-align: end;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <header class="bg-gray-400 text-white shadow">
                <div class="flex items-center mx-auto py-2 px-4 sm:px-6 lg:px-8">
                    <div>QR CODE GENERATION</div>
                    <form class="ml-auto" method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link class="text-white" :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                </div>


            </header>
            <div class="qr-logout">
                
            </div>

            <!-- Page Heading -->
            

            <!-- Page Content -->
            <main class="mx-auto py-2 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
