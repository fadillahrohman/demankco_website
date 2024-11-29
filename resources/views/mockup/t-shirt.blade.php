@extends('layouts.layout')

@section('title', 'Mockup - DMCO')

@section('content')
<div class="flex left mb-2 min-h-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Mockup</h1>
    <p class="text-gray-600 mb-8">Buat Mockupmu di sini</p>
  </div>
</div>

<div class="h-50 mb-2 flex w-fit grid-cols-2 gap-x-1 rounded-lg bg-white p-3 shadow-sm outline outline-1 outline-slate-200 justify-self-center">
  <div id="kiri" class="grid-rows-auto h-fit w-fit justify-items-center space-y-2 rounded-lg bg-white p-2 shadow-lg hover:divide-solid">
    <div class="rounded-lg bg-slate-50 outline outline-1 outline-slate-200 space-1">
      <button id="newText" class="flex w-full rounded-lg px-4 py-2 justify-center text-lg text-slate-700 transition duration-300 hover:bg-slate-200">Teks</button>
      <form class="flex flex-col">
        <label for="uploadImg" class="w-full cursor-pointer justify-center rounded-lg px-4 py-2 text-lg text-slate-700 hover:bg-slate-200">Gambar</label>
        <input type="file" id="uploadImg" class="hidden" onchange="showFileName(this)" />
        <span id="fileName" class="text-black"></span>
      </form>
      <button id="downImg" class="flex w-full rounded-lg px-4 py-2 justify-center text-lg text-slate-700 transition duration-300 hover:bg-slate-200">Simpan</button>
    </div>

    <button class="justify-center flex w-full rounded-lg bg-blue-500 px-4 py-2 text-lg font-medium text-white transition duration-300 hover:bg-blue-600 hover:text-white">
      <a href="{{ route('orderTshirt') }}">Pesan</a>
    </button>
    <button class="justify-center flex w-full rounded-lg px-4 py-2 text-lg text-slate-700 outline outline-1 outline-slate-200 transition duration-300 hover:bg-slate-200">
      <a href="{{ route('catalogs.list') }}">Kembali</a>
    </button>
  </div>

  <div id="tengah" class="rounded-lg bg-green-200 shadow-lg">
    <canvas id="canvas-bg" width="1098" height="720">canvas</canvas>
  </div>
</div>

<h1>rayhan</h1>
@endsection

@push('fabric_scripts')
    <script>
        // Tombol upload file
        function showFileName(input) {
          const fileNameSpan = document.getElementById("fileName");
          const file = input.files[0];

          if (file) {
            const maxLength = 20;
            const fileName = file.name;

            if (fileName.length > maxLength) {
              const shortName =
                fileName.substring(0, 10) + "..." + fileName.substring(fileName.length - 7);
              fileNameSpan.textContent = shortName;
            } else {
              fileNameSpan.textContent = fileName;
            }
          } else {
            fileNameSpan.textContent = "";
          }
        }

        // Background
        let canvas = new fabric.Canvas("canvas-bg", { 
          backgroundImage: "{{ asset('images/mockup-tshirt.png') }}",
                scaleToHeight: 720,
                scaleToWidth: 1098,
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