@extends('layouts.layout')

@section('title', 'Katalog - DMCO')

@section('content')
<div class="flex justify-center mb-2 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Katalog</h1>
    <p class="text-gray-600 mb-8">Cek katalog terbaru kami</p>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <div class="bg-white shadow-md rounded-lg overflow-hidden w-80 h-90">
        <img src="/images/tshirt.png" alt="Kaos polos biru" class="w-full h-56 object-cover">
        <div class="p-4">
          <h2 class="text-lg  mb-2">T-shirt</h2>
          <a href="{{ route('mockup') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">Mockup</a>
        </div>
      </div>
      <div class="bg-white shadow-md rounded-lg overflow-hidden w-80 h-90">
        <img src="/images/crewneck.png" alt="Crewneck" class="w-full h-56 object-cover">
        <div class="p-4">
          <h2 class="text-lg  mb-2">Crewneck</h2>
          <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">Mockup</a>
        </div>
      </div>
      <div class="bg-white shadow-md rounded-lg overflow-hidden w-80 h-90">
        <img src="/images/hoodie.png" alt="Hoodie" class="w-full h-56 object-cover">
        <div class="p-4">
          <h2 class="text-lg  mb-2">Hoodie</h2>
          <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors duration-300">Mockup</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
