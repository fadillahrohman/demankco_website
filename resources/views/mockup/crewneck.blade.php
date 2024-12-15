@extends('layouts.layout')

@section('title', 'Mockup - DMCO')

@section('content')
<div class="left mb-2 flex min-h-6">
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <h1 class="mb-4 text-3xl font-semibold text-[#3FA3FF]">Mockup</h1>
    <p class="mb-8 text-gray-600">Buat Mockupmu di sini</p>
  </div>
</div>

<div class="h-50 mb-2 flex w-fit grid-cols-2 gap-x-1 justify-self-center rounded-lg bg-white p-3 shadow-sm outline outline-1 outline-slate-200" data-aos="fade-up" data-aos-duration="100">
  <div id="kiri" class="grid-rows-auto h-fit w-fit justify-items-center space-y-2 rounded-lg bg-white p-2 shadow-lg outline outline-1 outline-slate-100 hover:divide-solid" data-aos="fade-up" data-aos-duration="600">
    <div class="space-1 rounded-lg bg-slate-50 outline outline-1 outline-slate-200">
      <button id="newText" class="flex w-full items-center justify-center gap-x-2 rounded-lg px-4 py-2 text-lg text-slate-700 transition duration-300 hover:bg-slate-200"><i class="fa-regular fa-i"></i> Teks</button>
      <form class="flex flex-col">
        <label for="uploadImg" class="w-full cursor-pointer justify-center rounded-lg px-4 py-2 text-lg text-slate-700 hover:bg-slate-200"><i class="fa-solid fa-image"></i> Gambar</label>
        <input type="file" id="uploadImg" class="hidden" multiple />
        <ul id="fileList" class="mt-2 list-disc text-black"></ul>
      </form>
      <button id="downImg" class="flex w-full items-center justify-center gap-x-2 rounded-lg px-4 py-2 text-lg text-slate-700 transition duration-300 hover:bg-slate-200"><i class="fa-solid fa-download"></i> Simpan</button>
    </div>
    <button class="flex w-full justify-center rounded-lg bg-blue-500 px-4 py-2 text-lg font-medium text-white transition duration-300 hover:bg-blue-600 hover:text-white">
      <a href="{{ route('orderCrewneck') }}" onclick="saveMockupImage()">Pesan</a>
    </button>
    <button class="flex w-full justify-center rounded-lg px-4 py-2 text-lg text-slate-700 outline outline-1 outline-slate-200 transition duration-300 hover:bg-slate-200">
      <a href="{{ route('catalogs.list') }}">Kembali</a>
    </button>
    <div id="divHapus" class="hidden justify-self-center rounded-lg bg-red-500 px-4 py-2 text-lg font-medium text-white shadow-lg transition duration-300 hover:bg-red-600 hover:text-white">
      <button id="hapusObj" type="button" onclick="delObj()"><i class="fa-solid fa-trash"></i> Hapus</button>
    </div>
    <div class="flex max-w-sm text-lg font-bold text-green-500">Biaya sablon:</div>
    <div id="price" class="hidden max-w-sm text-lg font-bold text-green-500">Rp. 150,000</div>
  </div>

  <div id="tengah" class="justify-items-start relative z-0 rounded-lg bg-green-200 pt-6 shadow-lg" data-aos="fade-up" data-aos-duration="800">
    <div id="propertiObj" class="hidden duration-600 absolute z-10 left-0 h-auto w-auto justify-items-center rounded-lg bg-slate-50 text-lg text-slate-700 outline outline-1 outline-slate-300 transition hover:shadow-lg">
      <p>Properti Obek</p>

    </div>
    <canvas id="canvas-bg" width="1098" height="549" class="">canvas</canvas>
  </div>
</div>

<div class="pt-10"></div>

@endsection

@push('fabric_scripts')
  <script>

    let canvas;

    document.addEventListener("DOMContentLoaded", function() {

        fabric.Image.fromURL("{{ asset('images/mockup-crewneck.png') }}", function(img) {
        canvas = new fabric.Canvas("canvas-bg", { 
          scaleToHeight: 549,
          scaleToWidth: 1098,
        });
        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));

        const targetAreaA3 = {
            left: 720, top: 140, right: 930, bottom: 400, harga: 45000
        };

        const targetAreaLogo = {
            left: 290, top: 175, right: 370, bottom: 250, harga: 10000
        };

        const targetArea21cm = {
        left: 650, top: 100, right: 1000, bottom: 600, price: 100000
        };

        const boundaryAreaA3 = new fabric.Rect({
            left: targetAreaA3.left,
            top: targetAreaA3.top,
            width: targetAreaA3.right - targetAreaA3.left,
            height: targetAreaA3.bottom - targetAreaA3.top,
            fill: 'rgba(0, 0, 0, 0)',
            stroke: 'red',            
            strokeWidth: 2,  
            opacity: 0.1,
            strokeDashArray: [5, 5],         
            selectable: false         
        });
        canvas.add(boundaryAreaA3);

        const boundaryAreaLogo = new fabric.Rect({
            left: targetAreaLogo.left,
            top: targetAreaLogo.top,
            width: targetAreaLogo.right - targetAreaLogo.left,
            height: targetAreaLogo.bottom - targetAreaLogo.top,
            fill: 'rgba(0, 0, 0, 0)',
            stroke: 'blue',   
            strokeWidth: 2,
            opacity: 0.1,
            strokeDashArray: [5, 5], 
            selectable: false      
        });
        canvas.add(boundaryAreaLogo);

        canvas.on('selection:created', function() {
            divHapus.classList.remove("hidden");
            propertiObj.classList.remove("hidden");
        });

        canvas.on("selection:created", function (e) {
        let totalPrice = 0;
        let isAnyObjectInArea = false;

        canvas.getActiveObjects().forEach(function (obj) {
            if (isObjectInArea(obj, targetAreaA3)) {
                totalPrice += targetAreaA3.harga;
                isAnyObjectInArea = true;
            }
            if (isObjectInArea(obj, targetAreaLogo)) {
                totalPrice += targetAreaLogo.harga;
                isAnyObjectInArea = true;
            }
        });

            if (isAnyObjectInArea) {
                priceElement.classList.remove("hidden");
                priceElement.textContent = "Rp. " + totalPrice.toLocaleString();
            } else {
                priceElement.classList.add("hidden");
                priceElement.textContent = "";
            }
        });


        canvas.on('selection:updated', function() {
            divHapus.classList.remove("hidden");
            propertiObj.classList.remove("hidden");
        });

        canvas.on('selection:cleared', function() {
            divHapus.classList.add("hidden");
            propertiObj.classList.add("hidden");
        });

        const priceElement = document.getElementById("price");

        function isObjectInArea(obj, area) {
        const objLeft = obj.left;
        const objTop = obj.top;
        const objRight = obj.left + obj.width * obj.scaleX;
        const objBottom = obj.top + obj.height * obj.scaleY;

        return (
            objLeft >= area.left &&
            objTop >= area.top &&
            objRight <= area.right &&
            objBottom <= area.bottom
        );
    }


    canvas.on("object:moving", function (e) {
        let totalPrice = 0;
        let isAnyObjectInArea = false;
        targetAreaA3.opacity = 0.1;
        targetAreaLogo.opacity = 0.1;

        canvas.getObjects().forEach(function (obj) {
            if (isObjectInArea(obj, targetAreaA3)) {
                totalPrice += targetAreaA3.harga;
                isAnyObjectInArea = true;
                targetAreaA3.opacity = 1;
            }
            if (isObjectInArea(obj, targetAreaLogo)) {
                totalPrice += targetAreaLogo.harga;
                isAnyObjectInArea = true;
                targetAreaLogo.opacity = 1;
            }
        });

            if (isAnyObjectInArea) {
                priceElement.classList.remove("hidden");
                priceElement.textContent = "Rp. " + totalPrice.toLocaleString();
            } else {
                priceElement.classList.add("hidden");
                priceElement.textContent = "";
            }
        });


        priceElement.classList.add("hidden");
        priceElement.textContent = "";

        document.getElementById("newText").addEventListener("click", function () {
        const newText = new fabric.Textbox("Masukkan teks di sini", {
            left: 100,
            top: 100,
            fill: "black",
        });

        canvas.add(newText);

        priceElement.classList.add("hidden");
        priceElement.textContent = "";
        });

        document.getElementById("uploadImg").addEventListener("change", function (e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function (f) {
                var data = f.target.result;
                fabric.Image.fromURL(data, function (img) {
                    img.set({ left: 0, top: 0, angle: 0 });
                    img.scaleToHeight(100);
                    img.scaleToWidth(200);
                    canvas.add(img).renderAll();

                    priceElement.classList.add("hidden");
                    priceElement.textContent = "";
                });
            };
            reader.readAsDataURL(file);
        });


        // Download gambar
        document.getElementById('downImg').addEventListener('click', function() {
        boundaryAreaA3.visible = false;
        boundaryAreaLogo.visible = false;
        const dataURL = canvas.toDataURL({ format: 'jpeg', quality: 1 });
        const link = document.createElement('a');
        link.href = dataURL;
        link.download = 'Mockup.jpeg';
        link.click();
        boundaryAreaA3.visible = true;
        boundaryAreaLogo.visible = true;
        });
        
        

    // Update harga
    canvas.on('object:moving', updatePrice);
    canvas.on('object:modified', updatePrice);
    canvas.on('object:added', function(e) {
        e.target.set({
            price: 0
        });
    });

    function updatePrice() {
        let totalPrice = 0;
        let isAnyObjectInArea = false;

        canvas.getObjects().forEach(function(obj) {
            if (obj.type === 'rect') return;
            
            if (isObjectInArea(obj, targetAreaA3)) {
                totalPrice += targetAreaA3.harga;
                isAnyObjectInArea = true;
                targetAreaA3.opacity = 1;
            } else if (isObjectInArea(obj, targetAreaLogo)) {
                totalPrice += targetAreaLogo.harga;
                isAnyObjectInArea = true;
                targetAreaLogo.opacity = 1;
            }
        });

        if (isAnyObjectInArea) {
            priceElement.classList.remove("hidden");
            priceElement.textContent = "Rp. " + totalPrice.toLocaleString();
        } else {
            priceElement.classList.add("hidden");
            priceElement.textContent = "";
        }
    }

    document.getElementById('uploadImg').addEventListener("change", function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function(f) {
            var data = f.target.result;
            const timestamp = new Date().getTime();
            fabric.Image.fromURL(data + '?t=' + timestamp, function(img) {
                img.set({
                    left: 100,
                    top: 100,
                    angle: 0,
                    price: 0
                });
                img.scaleToHeight(100);
                img.scaleToWidth(200);
                canvas.add(img).renderAll();
            });
        };
        reader.readAsDataURL(file);
        e.target.value = '';
    });

    // function delObj() {
    //     const activeObject = canvas.getActiveObject();
    //     if (activeObject) {
    //         canvas.remove(activeObject);
    //         canvas.discardActiveObject().renderAll();
    //         updatePrice();
    //     }
    // }

    // Update area opasitas
    function updateAreaOpacity() {
        let objectInA3 = false;
        let objectInLogo = false;

        canvas.getObjects().forEach(function(obj) {
            if (obj.type === 'rect') return;
            
            if (isObjectInArea(obj, targetAreaA3)) {
                objectInA3 = true;
            }
            if (isObjectInArea(obj, targetAreaLogo)) {
                objectInLogo = true;
            }
        });

        boundaryAreaA3.set('opacity', objectInA3 ? 1 : 0.1);
        boundaryAreaLogo.set('opacity', objectInLogo ? 1 : 0.1);
        canvas.renderAll();
    }

    // Event listener
    canvas.on('object:moving', updateAreaOpacity);
    canvas.on('object:modified', updateAreaOpacity);
    canvas.on('object:added', updateAreaOpacity);
    canvas.on('object:removed', updateAreaOpacity);

    // Panel properti objek
    canvas.on('selection:created', function(e) {
        const activeObj = e.target;
        const propertiObj = document.getElementById('propertiObj');
        
        propertiObj.innerHTML = '<p class="font-bold p-2">Properti Objek</p>';
        
        const sizeControls = `
            <div class="p-2">
                <label class="block text-sm">Ukuran:</label>
                <input type="number" id="objWidth" value="${Math.round(activeObj.getScaledWidth())}" class="w-20 p-1 border rounded bg-slate-100 outline outline-1 outline-slate-300">
                <span class="mx-1">x</span>
                <input type="number" id="objHeight" value="${Math.round(activeObj.getScaledHeight())}" class="w-20 p-1 border rounded bg-slate-100 outline outline-1 outline-slate-100">
            </div>
        `;

        // Properti teks
        let textControls = '';
        if (activeObj.type === 'textbox') {
            textControls = `
                <div class="p-2">
                    <label class="block text-sm">Font:</label>
                    <select id="fontFamily" class="w-full p-1 border rounded bg-slate-100 outline outline-1 outline-slate-200">
                        <option value="Arial">Arial</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Courier New">Courier New</option>
                    </select>
                    
                    <label class="block text-sm mt-2">Ukuran Font:</label>
                    <input type="number" id="fontSize" value="${activeObj.fontSize}" class="w-20 p-1 border rounded bg-slate-100 outline outline-1 outline-slate-200">
                    
                    <label class="block text-sm mt-2">Warna:</label>
                    <input type="color" id="textColor" value="${activeObj.fill}" class="p-1">
                    
                    <div class="mt-2">
                        <button id="boldText" class="p-1 border rounded"><i class="fas fa-bold"></i></button>
                        <button id="italicText" class="p-1 border rounded"><i class="fas fa-italic"></i></button>
                        <button id="underlineText" class="p-1 border rounded"><i class="fas fa-underline"></i></button>
                    </div>
                </div>
            `;
        }
        
        propertiObj.innerHTML += sizeControls + textControls;
        // // alignControls
        // propertiObj.classList.remove('hidden');

        // Properti teks
        if (activeObj.type === 'textbox') {
            document.getElementById('fontFamily').addEventListener('change', function(e) {
                activeObj.set('fontFamily', e.target.value);
                canvas.renderAll();
            });

            document.getElementById('fontSize').addEventListener('change', function(e) {
                activeObj.set('fontSize', parseInt(e.target.value));
                canvas.renderAll();
            });

            document.getElementById('textColor').addEventListener('input', function(e) {
                activeObj.set('fill', e.target.value);
                canvas.renderAll();
            });

            document.getElementById('boldText').addEventListener('click', function() {
                activeObj.set('fontWeight', activeObj.fontWeight === 'bold' ? 'normal' : 'bold');
                canvas.renderAll();
            });

            document.getElementById('italicText').addEventListener('click', function() {
                activeObj.set('fontStyle', activeObj.fontStyle === 'italic' ? 'normal' : 'italic');
                canvas.renderAll();
            });

            document.getElementById('underlineText').addEventListener('click', function() {
                activeObj.set('underline', !activeObj.underline);
                canvas.renderAll();
            });
        }

        // Prpoperti ukuran objek
        document.getElementById('objWidth').addEventListener('change', function(e) {
            activeObj.scaleToWidth(parseInt(e.target.value));
            canvas.renderAll();
            updateAreaOpacity();
        });

        document.getElementById('objHeight').addEventListener('change', function(e) {
            activeObj.scaleToHeight(parseInt(e.target.value));
            canvas.renderAll();
            updateAreaOpacity();
        });

        // Sembunyikan panel properti
        canvas.on('selection:cleared', function() {
            document.getElementById('propertiObj').classList.add('hidden');
        });

    });
    
    });
    
    });

    // Hapus objek
    function delObj() {
        const activeObject = canvas.getActiveObject();
        if (activeObject) {
            canvas.remove(activeObject);
            canvas.discardActiveObject().renderAll();
            updatePrice();

        // Reset harga
        let totalPrice = 0;
        let isAnyObjectInArea = false;

        canvas.getObjects().forEach(function (obj) {
                if (isObjectInArea(obj, targetAreaA3)) {
                    totalPrice += targetAreaA3.harga;
                    isAnyObjectInArea = true;
                    targetAreaA3.opacity = 1;
                }
                if (isObjectInArea(obj, targetAreaLogo)) {
                    totalPrice += targetAreaLogo.harga;
                    isAnyObjectInArea = true;
                    targetAreaLogo.opacity = 1;
                }
            });

            if (isAnyObjectInArea) {
                priceElement.classList.remove("hidden");
                priceElement.textContent = "Rp. " + totalPrice.toLocaleString();
            } else {
                priceElement.classList.add("hidden");
                priceElement.textContent = "";
            }
        }
    }

    </script>

    <script>

        const boundaryAreaA3 = document.getElementById("boundaryAreaA3");
        const boundaryAreaLogo = document.getElementById("boundaryAreaLogo");

        // Simpan harga sablon sementara
        function simpanHargaSablon() {
            const hargaSablon = document.getElementById('price').textContent.replace('Rp. ', '').replace(/\./g, '').replace(',', '').trim();
            localStorage.setItem('hargaSablon', hargaSablon || '0');
        }

        // Simpan mockup sementara
        function saveMockupImage() {
        if (canvas instanceof fabric.Canvas) {
            const boundaryAreaA3 = canvas.getObjects().find(obj => obj.type === 'rect' && obj.stroke === 'red');
            const boundaryAreaLogo = canvas.getObjects().find(obj => obj.type === 'rect' && obj.stroke === 'blue');

            if (boundaryAreaA3) boundaryAreaA3.set('visible', false);
            if (boundaryAreaLogo) boundaryAreaLogo.set('visible', false);

            canvas.renderAll();
            const mockupImage = canvas.toDataURL('image/png');
            localStorage.setItem('mockupImage', mockupImage);

            // Kembalikan visibilitas boundary area
            if (boundaryAreaA3) boundaryAreaA3.set('visible', true);
            if (boundaryAreaLogo) boundaryAreaLogo.set('visible', true);
            canvas.renderAll();
        }
    }

        // Tambahkan onclick ke tombol Pesan
        document.querySelector('a[href="{{ route('orderCrewneck') }}"]').addEventListener('click', function(event) {
            saveMockupImage();
            simpanHargaSablon();
            event.preventDefault();
            window.location.href = "{{ route('orderCrewneck') }}";
        });
    </script>

@endpush