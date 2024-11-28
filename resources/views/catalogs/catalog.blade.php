@extends('layouts.layout')

@section('title', 'Katalog - DMCO')

@section('content')
<div class="flex justify-center mb-2 min-h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Katalog</h1>
    <p class="text-gray-600 mb-8">Cek katalog terbaru kami</p>

    @if (count($catalogs) > 0)
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($catalogs as $catalog)
          <div class="bg-white shadow-md rounded-lg overflow-hidden w-80 h-90">
            @if (isset($catalog['image']) && $catalog['image'])
              <img src="{{ asset('uploads/catalogs/'.$catalog['image']) }}" 
                   alt="{{ $catalog['name'] }}" 
                   class="w-full h-56 object-cover">
            @else
              <img src="{{ asset('images/default-placeholder.png') }}" 
                   alt="No IMAGE" 
                   class="w-full h-56 object-cover">
            @endif

            <div class="p-4">
              <h2 class="text-lg mb-2 font-semibold">{{ $catalog['name'] }}</h2>
              {{-- <p class="text-sm text-gray-500 mb-4">{{ number_format($catalog['price'], 0, ',', '.') }} IDR</p> --}}
              @if ($catalog['type'] === 'Tshirt')
              <a href="{{ route('mockT-shirt') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                  Mockup T-shirt
              </a>
          @elseif ($catalog['type'] === 'Crewneck')
              <a href="{{ route('mockCrewneck') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                  Mockup Crewneck
              </a>
          @elseif ($catalog['type'] === 'Hoodie')
              <a href="{{ route('mockHoodie') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                  Mockup Hoodie
              </a>
          @endif

            </div>
          </div>
        @endforeach
      </div>
    @else
      <p class="text-center text-gray-500">Tidak ada katalog yang tersedia.</p>
    @endif
  </div>
</div>
@endsection
