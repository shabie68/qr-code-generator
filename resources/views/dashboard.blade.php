<x-app-layout>
	<div class="flex flex-col md:flex-row items-start justify-between bg-white shadow-md rounded-lg p-6 space-y-6 md:space-y-0 md:space-x-6">
  
  <!-- User Info and Sentence -->
  <div class="flex-1">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome, <span class="break-all text-blue-600">{{ $user->email }}</span></h2>
    
    <h3 class="text-xl font-semibold text-gray-700 mb-1">AI-generated Sentence:</h3>
    <p class="text-gray-600 bg-gray-100 p-3 rounded-md border border-gray-200">
      {{ $sentence }}
    </p>
  </div>

  <!-- QR Code -->
  <div class="w-full md:w-auto text-center md:text-right">
    <p class="text-gray-700 font-medium mb-2 text-start">Your QR Code:</p>
    <div class="inline-block border border-gray-300 p-2 rounded-md bg-white shadow-sm">
      {!! $qr !!}
    </div>
  </div>

</div>

</x-app-layout>
