@extends('layouts.layout')

@section('title', 'Mockup - DMCO')

@section('content')
<div class="flex left mb-2 min-h-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Mockup</h1>
    <p class="text-gray-600 mb-8">Buat Mockupmu di sini</p>
  </div>
</div>

<div class="flex left mb-2 min-h-6">
    <div class="">
        <input type="file" id="uploadImg"><br>
        <button id="newText" class="flex items-center text-white text-lg bg-blue-500 hover:bg-blue-600 font-medium rounded-lg px-4 py-2 transition duration-300">Tambah teks</button>
        <button id="downImg" class="flex items-center text-white text-lg bg-blue-500 hover:bg-blue-600 font-medium rounded-lg px-4 py-2 transition duration-300">Download</button>
        <button class="flex items-center text-white text-lg bg-blue-500 hover:bg-blue-600 font-medium rounded-lg px-4 py-2 transition duration-300">
            <a href="{{ route('orderHoodie') }}">Pesan</a>
        </button>
        <button id="klik" class="flex items-center text-white text-lg bg-blue-500 hover:bg-blue-600 font-medium rounded-lg px-4 py-2 transition duration-300">Tes3</button>
        <button id="klik" class="flex items-center text-white text-lg bg-blue-500 hover:bg-blue-600 font-medium rounded-lg px-4 py-2 transition duration-300">Tes4</button>
    </div>
    <div>
        <canvas id="canvas-bg" width="1200" height="1000" style="border:1px solid blue"></canvas> 
    </div>
</div>

<h1>rayhan</h1>
@endsection

@push('fabric_scripts')
    <script>
		// Background
		let canvas = new fabric.Canvas("canvas-bg", { 
			backgroundImage: "{{ asset('images/base_mockup.png') }}",
            scaleToHeight: 720,
            scaleToWidth: 640 
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