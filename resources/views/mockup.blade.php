@extends('layouts.layout')

@section('title', 'Mockup - DMCO')

@section('content')
<div class="flex-auto mb-2 min-h-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Mockup</h1>
    <p class="text-gray-600 mb-8">Buat Mockupmu di sini</p>
  </div>
</div>
<input type="file" id="gambarUpload"><br>
<div class="flex justify-center items-center min-h-screen shadow-md rounded">
  <canvas id="canvas-bg" width="720" height="720"></canvas>
</div>

@endsection

@push('fabric_scripts')
    {{-- Fabric.js --}}
    <script src="https://cdn.jsdelivr.net/npm/fabric@latest/dist/fabric.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = new fabric.Canvas('canvas-bg');
            // // Hapus
            // hapusBtn = document.getElementById('hapusObjek');
            // delBtn.style.display = 'none';
            // canvas-bg
            fabric.Image.fromURL("{{ asset('images/base_mockup.png') }}", function(img) {
            const scaleX = canvas.width / img.width;
            const scaleY = canvas.height / img.height;

            img.scaleToWidth(canvas.width);
            img.scaleToHeight(canvas.height);
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
        });

        // Upload gambar
        document.getElementById('gambarUpload').addEventListener("change", function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function (f) {
          var data = f.target.result;                    
          fabric.Image.fromURL(data, function (img) {
            var oImg = img.set({left: 0, top: 0, angle: 0,width:500, height:500}).scale(1);
            canvas.add(oImg).renderAll();
            var a = canvas.setActiveObject(oImg);
            var dataURL = canvas.toDataURL({format: 'png', quality: 0.8});
          });
        };

        reader.readAsDataURL(file);
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

            // Teks
            const text = new fabric.Textbox('Masukkan teks', {
                left: 100,
                top: 100,
                fill: 'blue'
            });

            // Fungsi
            canvas.add(text);
            canvas.centerObject(text);
            canvas.setActiveObject(text);
        });
    </script>
@endpush