@extends('layouts.layout')

@section('title', 'Mockup - DMCO')

@section('content')
<div class="flex left mb-2 min-h-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Mockup</h1>
    <p class="text-gray-600 mb-8">Buat Mockupmu di sini</p>
  </div>
</div>

<div class="mb-2 flex h-auto w-auto grid-cols-2 gap-x-1 rounded-lg bg-white p-3 shadow-sm">
    
    <div id="kiri" class="grid-rows-auto h-auto w-auto justify-items-center divide-y divide-solid rounded-lg bg-white p-2 shadow-lg hover:divide-solid outline outline-1 outline-slate-50">
      <form class="flex flex-col">
        <label for="uploadImg" class="w-full cursor-pointer justify-items-center rounded-lg px-4 py-2 text-lg font-medium text-slate-700 hover:bg-blue-600 hover:text-white"> Upload Gambar </label>
        <input type="file" id="uploadImg" class="hidden" onchange="showFileName(this)" />
        <span id="fileName" class="text-black"></span>
      </form>
  
      <button id="newText" class="flex w-full rounded-lg px-4 py-2 text-center text-lg font-medium text-slate-700 transition duration-300 hover:bg-blue-600 hover:text-white">Tambah teks</button>
      <button id="downImg" class="flex w-full rounded-lg px-4 py-2 text-center text-lg font-medium text-slate-700 transition duration-300 hover:bg-blue-600 hover:text-white">Download</button>
      <button class="items-center flex w-full rounded-lg bg-blue-500 px-4 py-2 text-lg font-medium text-white transition duration-300 hover:bg-blue-600 hover:text-white">
        <a href="{{ route('orderTshirt') }}">Pesan</a>
      </button>
         <button class="items-center flex w-full rounded-lg px-4 py-2 text-lg font-medium text-slate-700 transition duration-300 hover:bg-blue-600 hover:text-white">
        <a href="{{ route('catalogs.list') }}">Kembali</a>
      </button>
    </div>
  
    <div id="tengah" class="bg-green-200 rounded-lg shadow-lg">
      <canvas id="canvas-bg">canvas</canvas>
    </div>
  
</div>  

<h1>rayhan</h1>
@endsection

@push('fabric_scripts')
    <script>
        function showFileName(input) {
            const fileName = input.files[0]?.name || "Belum ada file";
            document.getElementById("fileName").textContent = fileName;
        }

		// Background
		let canvas = new fabric.Canvas("canvas-bg", { 
			backgroundImage: "{{ asset('images/base_mockup.png') }}",
            scaleToHeight: 640,
            scaleToWidth: 360 
		});

        // Editor objek
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

        document.getElementById("newText").addEventListener("click", function() {
            console.log('menambahkan teks');
            const newText = new fabric.Textbox('Masukkan teks di sini', {
                left: 100,
                top: 100,
                fill: 'black'
            });

            canvas.centerObject(newText);
            canvas.add(newText);
        });

        document.getElementById('uploadImg').addEventListener("change", function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function (f) {
                var data = f.target.result;                    
                fabric.Image.fromURL(data, function (img) {
                var oImg = img.set({left: 0, top: 0, angle: 0});
                img.scaleToHeight(100);
                img.scaleToWidth(200);
                canvas.add(oImg).renderAll();
                var a = canvas.setActiveObject(oImg);
                var dataURL = canvas.toDataURL({format: 'png', quality: 0.8});
                });
            };
            reader.readAsDataURL(file);
        });

        document.getElementById('downImg').addEventListener('click', function() {
            const dataURL = canvas.toDataURL({ format: 'jpeg', quality: 1 });
            const link = document.createElement('a');
            link.href = dataURL;
            link.download = 'Mockup.jpeg';
            link.click();
        });

    </script>
@endpush