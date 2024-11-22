@extends('layouts.layout')

@section('title', 'Mockup - DMCO')

@section('content')
<!-- Container Utama -->
<div class="flex">
    <!-- Kontrol di Kiri -->
    <div class="w-1/5 p-4 space-y-2">
        <button id="addTextBtn" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah Teks</button>
        <button id="uploadImageBtn" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Upload Gambar</button>
        <button id="downloadBtn" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Download Mockup</button>
        <button id="saveBtn" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan Progress</button>
        
        <!-- Input File Tersembunyi untuk Upload Gambar -->
        <input type="file" id="gambarUpload" accept="image/*" class="hidden">
    </div>

    <!-- Canvas di Tengah -->
    <div class="flex-1 flex justify-center items-center bg-gray-100">
        <canvas id="canvas-bg" width="1920" height="1080"></canvas>
    </div>

    <!-- Panel Properti di Kanan -->
    <div id="propertiesPanel" class="w-1/5 p-4 bg-white shadow-lg overflow-y-auto hidden">
        <h2 class="text-xl font-semibold mb-4">Properti Objek</h2>
        
        <!-- Properti Umum -->
        <div id="commonProperties" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Posisi X:</label>
                <input type="number" id="objLeft" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" step="1">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Posisi Y:</label>
                <input type="number" id="objTop" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md" step="1">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Opasitas:</label>
                <input type="range" id="objOpacity" min="0" max="1" step="0.1" class="w-full">
            </div>
            <div>
                <button id="deleteObjBtn" class="w-full px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Hapus Objek</button>
            </div>
        </div>
        
        <!-- Properti Teks -->
        <div id="textProperties" class="space-y-4 hidden">
            <div>
                <label class="block text-sm font-medium text-gray-700">Teks:</label>
                <input type="text" id="objText" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Warna Teks:</label>
                <input type="color" id="objTextColor" class="mt-1 block w-full h-10 border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Ukuran Teks:</label>
                <input type="number" id="objTextSize" min="10" max="100" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis:</label>
                <select id="objTextStyle" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md">
                    <option value="regular">Regular</option>
                    <option value="bold">Bold</option>
                    <option value="italic">Italic</option>
                    <option value="underline">Underline</option>
                </select>
            </div>
        </div>
        
        <!-- Properti Gambar -->
        <div id="imageProperties" class="space-y-4 hidden">
            <div>
                <label class="block text-sm font-medium text-gray-700">Lebar:</label>
                <input type="number" id="objWidth" min="50" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Tinggi:</label>
                <input type="number" id="objHeight" min="50" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alignment:</label>
                <select id="objAlignment" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md">
                    <option value="left">Kiri</option>
                    <option value="center">Tengah</option>
                    <option value="right">Kanan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Flip:</label>
                <select id="objFlip" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md">
                    <option value="none">Tidak</option>
                    <option value="horizontal">Horizontal</option>
                    <option value="vertical">Vertikal</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Properti Teks -->
<div id="textModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Properti Teks</h2>
        <form id="textForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Teks:</label>
                <input type="text" id="textContent" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Warna Teks:</label>
                <input type="color" id="textColor" value="#000000"
                    class="mt-1 block w-full h-10 border-gray-300 rounded-md">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Ukuran Teks:</label>
                <input type="number" id="textSize" value="20" min="10" max="100"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Jenis:</label>
                <select id="textStyle"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <option value="regular">Regular</option>
                    <option value="bold">Bold</option>
                    <option value="italic">Italic</option>
                    <option value="underline">Underline</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="cancelTextBtn"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah</button>
            </div>
        </form>
    </div>
</div>

<!-- Properti Gambar -->
<div id="imageModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-semibold mb-4">Pengaturan Gambar</h2>
        <form id="imageForm" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Ukuran:</label>
                <div class="flex space-x-2">
                    <input type="number" id="imageWidth" placeholder="Lebar" min="50"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <input type="number" id="imageHeight" placeholder="Tinggi" min="50"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Alignment:</label>
                <select id="imageAlignment"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="left">Kiri</option>
                    <option value="center">Tengah</option>
                    <option value="right">Kanan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Flip:</label>
                <select id="imageFlip"
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="none">Tidak</option>
                    <option value="horizontal">Horizontal</option>
                    <option value="vertical">Vertikal</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="cancelImageBtn"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">Terapkan</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('fabric_scripts')
    <!-- Muat Fabric.js dari CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.6.0/fabric.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Canvas
            let canvas = new fabric.Canvas("canvas-bg", { 
                backgroundImage: "{{ asset('images/base_mockup.png') }}",
                backgroundImageOpacity: 1,
                backgroundImageStretch: true
            });

            // Fungsi Resize Canvas
            function resizeCanvas() {
                const canvasElement = document.getElementById('canvas-bg');
                canvas.setWidth(canvasElement.clientWidth);
                canvas.setHeight(canvasElement.clientHeight);
                canvas.renderAll();
            }

            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            // Set Properti Default untuk Semua Objek
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

            // Tombol Teks
            const addTextBtn = document.getElementById('addTextBtn');
            const textModal = document.getElementById('textModal');
            const cancelTextBtn = document.getElementById('cancelTextBtn');
            const textForm = document.getElementById('textForm');

            addTextBtn.addEventListener('click', () => {
                textModal.classList.remove('hidden');
            });

            cancelTextBtn.addEventListener('click', () => {
                textModal.classList.add('hidden');
                textForm.reset();
            });

            textForm.addEventListener('submit', (e) => {
                e.preventDefault();
                const content = document.getElementById('textContent').value;
                const color = document.getElementById('textColor').value;
                const size = parseInt(document.getElementById('textSize').value);
                const style = document.getElementById('textStyle').value;

                let fontWeight = 'normal';
                let fontStyle = 'normal';
                let underline = false;

                if (style === 'bold') {
                    fontWeight = 'bold';
                } else if (style === 'italic') {
                    fontStyle = 'italic';
                } else if (style === 'underline') {
                    underline = true;
                }

                const text = new fabric.Text(content, {
                    left: 100,
                    top: 100,
                    fill: color,
                    fontSize: size,
                    fontWeight: fontWeight,
                    fontStyle: fontStyle,
                    underline: underline,
                    selectable: true
                });

                canvas.add(text);
                canvas.setActiveObject(text);
                canvas.renderAll();

                textModal.classList.add('hidden');
                textForm.reset();
            });

            // Tombol Upload Gambar
            const uploadImageBtn = document.getElementById('uploadImageBtn');
            const gambarUploadInput = document.getElementById('gambarUpload');

            uploadImageBtn.addEventListener('click', () => {
                gambarUploadInput.click();
            });

            gambarUploadInput.addEventListener("change", function (e) {
                var file = e.target.files[0];
                if (!file) return;

                var reader = new FileReader();
                reader.onload = function (f) {
                    var data = f.target.result;                    
                    fabric.Image.fromURL(data, function (img) {
                        var oImg = img.set({left: 100, top: 100, angle: 0}).scale(0.5);
                        canvas.add(oImg).renderAll();
                        canvas.setActiveObject(oImg);
                    });
                };

                reader.readAsDataURL(file);
            });

            // Tombol Download
            const downloadBtn = document.getElementById('downloadBtn');
            downloadBtn.addEventListener('click', () => {
                const dataURL = canvas.toDataURL({
                    format: 'png',
                    quality: 1
                });
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'mockup.png';
                link.click();
            });

            // Tombol Simpan
            const saveBtn = document.getElementById('saveBtn');
            saveBtn.addEventListener('click', () => {
                const canvasState = JSON.stringify(canvas.toJSON());

                // Ambil CSRF Token dari Meta Tag
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route("mockup.save") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ state: canvasState })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    alert(data.message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan progress.');
                });
            });

            // Load State saat Halaman Dimuat
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route("mockup.load") }}', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.state) {
                    canvas.loadFromJSON(data.state, canvas.renderAll.bind(canvas), function(o, object) {
                        // Callback jika diperlukan
                    });
                    alert('Progress mockup berhasil dimuat.');
                }
            })
            .catch(error => {
                console.error('Error loading mockup:', error);
            });

            // Event untuk Menampilkan Panel Properti saat Objek Dipilih
            canvas.on('selection:created', updatePropertiesPanel);
            canvas.on('selection:updated', updatePropertiesPanel);
            canvas.on('selection:cleared', function() {
                document.getElementById('propertiesPanel').classList.add('hidden');
            });

            function updatePropertiesPanel() {
                const activeObject = canvas.getActiveObject();
                if (!activeObject) {
                    document.getElementById('propertiesPanel').classList.add('hidden');
                    return;
                }

                document.getElementById('propertiesPanel').classList.remove('hidden');
                
                // Update properti umum
                document.getElementById('objLeft').value = Math.round(activeObject.left);
                document.getElementById('objTop').value = Math.round(activeObject.top);
                document.getElementById('objOpacity').value = activeObject.opacity;

                // Tampilkan properti spesifik berdasarkan tipe objek
                if (activeObject.type === 'text') {
                    // Tampilkan properti teks
                    document.getElementById('textProperties').classList.remove('hidden');
                    document.getElementById('imageProperties').classList.add('hidden');

                    // Update properti teks
                    document.getElementById('objText').value = activeObject.text;
                    document.getElementById('objTextColor').value = activeObject.fill;
                    document.getElementById('objTextSize').value = activeObject.fontSize;
                    document.getElementById('objTextStyle').value = activeObject.fontWeight === 'bold' ? 'bold' :
                        activeObject.fontStyle === 'italic' ? 'italic' :
                        activeObject.underline ? 'underline' : 'regular';

                } else if (activeObject.type === 'image') {
                    // Tampilkan properti gambar
                    document.getElementById('textProperties').classList.add('hidden');
                    document.getElementById('imageProperties').classList.remove('hidden');

                    // Update properti gambar
                    document.getElementById('objWidth').value = Math.round(activeObject.width * activeObject.scaleX);
                    document.getElementById('objHeight').value = Math.round(activeObject.height * activeObject.scaleY);
                    // Tambahkan pengaturan alignment dan flip jika diperlukan
                }
            }

            // Event Handler untuk Properti Umum
            document.getElementById('objLeft').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeObject.set('left', parseInt(this.value));
                    canvas.renderAll();
                }
            });

            document.getElementById('objTop').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeObject.set('top', parseInt(this.value));
                    canvas.renderAll();
                }
            });

            document.getElementById('objOpacity').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject) {
                    activeObject.set('opacity', parseFloat(this.value));
                    canvas.renderAll();
                }
            });

            // Event Handler untuk Properti Teks
            document.getElementById('objText').addEventListener('input', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'text') {
                    activeObject.set('text', this.value);
                    canvas.renderAll();
                }
            });

            document.getElementById('objTextColor').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'text') {
                    activeObject.set('fill', this.value);
                    canvas.renderAll();
                }
            });

            document.getElementById('objTextSize').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'text') {
                    activeObject.set('fontSize', parseInt(this.value));
                    canvas.renderAll();
                }
            });

            document.getElementById('objTextStyle').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'text') {
                    const style = this.value;
                    activeObject.set({
                        fontWeight: style === 'bold' ? 'bold' : 'normal',
                        fontStyle: style === 'italic' ? 'italic' : 'normal',
                        underline: style === 'underline' ? true : false
                    });
                    canvas.renderAll();
                }
            });

            // Event Handler untuk Properti Gambar
            document.getElementById('objWidth').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    activeObject.scaleToWidth(parseInt(this.value));
                    canvas.renderAll();
                }
            });

            document.getElementById('objHeight').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    activeObject.scaleToHeight(parseInt(this.value));
                    canvas.renderAll();
                }
            });

            document.getElementById('objAlignment').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    if (this.value === 'left') {
                        activeObject.set('left', 0);
                    } else if (this.value === 'center') {
                        activeObject.centerH();
                    } else if (this.value === 'right') {
                        activeObject.set('left', canvas.width - activeObject.width * activeObject.scaleX);
                    }
                    canvas.renderAll();
                }
            });

            document.getElementById('objFlip').addEventListener('change', function() {
                const activeObject = canvas.getActiveObject();
                if (activeObject && activeObject.type === 'image') {
                    if (this.value === 'horizontal') {
                        activeObject.toggle('flipX');
                    } else if (this.value === 'vertical') {
                        activeObject.toggle('flipY');
                    }
                    canvas.renderAll();
                }
            });

            // Tombol Hapus Objek
            document.getElementById('deleteObjBtn').addEventListener('click', () => {
                const activeObject = canvas.getActiveObject();
                if (activeObject) {
                    canvas.remove(activeObject);
                    document.getElementById('propertiesPanel').classList.add('hidden');
                }
              });
        });
    </script>
@endpush