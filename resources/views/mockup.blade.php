@extends('layouts.layout')

@section('title', 'Katalog - DMCO')

@section('content')
<div class="flex justify-center mb-2 min-h-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Mockup</h1>
    <p class="text-gray-600 mb-8">Buat Mockupmu di sini</p>
  </div>
</div>
<div class="flex justify-center mb-2 min-h-8 bg-slate-100">
  <canvas id="canvasEl" width="1300" height="720"></canvas>
</div>
@endsection

@push('fabric_scripts') {{-- Fabric.js --}}
  <script src="https://cdn.jsdelivr.net/npm/fabric@latest/dist/fabric.min.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          const canvasEl = document.getElementById('canvasEl');
          const canvas = new fabric.Canvas(canvasEl);

          fabric.Object.prototype.set({
              cornerStyle: 'rect',
              cornerStrokeColor: 'blue',
              cornerColor: 'lightblue',
              padding: 10,
              transparentCorners: false,
              cornerDashArray: null,
              borderColor: 'blue',
              borderDashArray: null,
              borderScaleFactor: 2,
          });

          const text = new fabric.Text('Masukkan teks di sini', {
              left: 100,
              top: 100,
              fill: 'black'
          });

          canvas.add(text);
          canvas.centerObject(text);
          canvas.setActiveObject(text);
      });
  </script>
@endpush