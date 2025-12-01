@extends('layouts.layout')

@section('title', 'Mockup - DMCO')

@section('content')
    <div class="align-start mb-2 flex min-h-6">
        <div class="max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <h1 class="mb-4 text-3xl font-semibold text-[#3FA3FF]">Mockup</h1>
            <p class="mb-8 text-gray-600">Buat Mockup kamu di sini</p>
        </div>
    </div>

    <div class="h-50 mb-2 flex grid-cols-2 gap-x-1 justify-self-center rounded-lg bg-red-600 p-3 shadow-sm outline outline-1 outline-slate-200"
        data-aos="fade-up" data-aos-duration="100">
        <div id="kiri"
            class="grid-rows-auto h-fit w-fit justify-items-center space-y-2 rounded-lg bg-white p-2 shadow-lg outline outline-1 outline-slate-100 hover:divide-solid"
            data-aos="fade-up" data-aos-duration="600">
            <div class="space-1 rounded-lg bg-slate-50 outline outline-1 outline-slate-200">
                <button id="newText"
                    class="flex w-full items-center justify-center gap-x-2 rounded-lg px-4 py-2 text-lg text-slate-700 transition duration-300 hover:bg-slate-200"><i
                        class="fa-regular fa-i"></i> Teks</button>
                <form class="flex flex-col">
                    <label for="uploadImg"
                        class="w-full cursor-pointer justify-center rounded-lg px-4 py-2 text-lg text-slate-700 hover:bg-slate-200"><i
                            class="fa-solid fa-image"></i> Gambar</label>
                    <input type="file" id="uploadImg" class="hidden" multiple />
                    <ul id="fileList" class="mt-2 list-disc text-black"></ul>
                </form>
                <button id="downImg"
                    class="flex w-full items-center justify-center gap-x-2 rounded-lg px-4 py-2 text-lg text-slate-700 transition duration-300 hover:bg-slate-200"><i
                        class="fa-solid fa-download"></i> Simpan</button>
            </div>
            <button id="pesanButton"
                class="flex w-full justify-center rounded-lg bg-blue-500 px-4 py-2 text-lg font-medium text-white transition duration-300 hover:bg-blue-600 hover:text-white"
                disabled>
                <a href="{{ route('orderTshirt') }}" onclick="saveMockupImage()">Pesan</a>
            </button>
            <button
                class="flex w-full justify-center rounded-lg px-4 py-2 text-lg text-slate-700 outline outline-1 outline-slate-200 transition duration-300 hover:bg-slate-200">
                <a href="{{ route('catalogs.list') }}">Kembali</a>
            </button>
            <div id="divHapus"
                class="hidden justify-self-center rounded-lg bg-red-500 px-4 py-2 text-lg font-medium text-white shadow-lg transition duration-300 hover:bg-red-600 hover:text-white">
                <button id="hapusObj" type="button" onclick="delObj()"><i class="fa-solid fa-trash"></i> Hapus</button>
            </div>
            <div class="flex max-w-sm text-lg font-bold text-green-500">Biaya sablon:</div>
            <div id="price" class="hidden max-w-sm text-lg font-bold text-green-500">Rp. 150,000</div>
        </div>

        <div id="tengah" class="justify-items-start relative z-0 rounded-lg bg-green-200 pt-6 shadow-lg w-full"
            data-aos="fade-up" data-aos-duration="800">
            <div id="propertiObj"
                class="hidden duration-600 absolute z-10 left-0 h-auto w-auto justify-items-center rounded-lg bg-slate-50 text-lg text-slate-700 outline outline-1 outline-slate-300 transition hover:shadow-lg">
                <p>Properti Objek</p>

            </div>
                <canvas id="canvas-bg" class="">canvas</canvas>
        </div>
    </div>
    <div class="pt-10"></div>
@endsection

@push('fabric_scripts')
    <script>
        let canvas;
        let bgImageRef = null;
        let currentCanvasWidth = 0;
        let currentCanvasHeight = 0;

        document.addEventListener("DOMContentLoaded", function() {
            const canvasEl = document.getElementById('canvas-bg');
            const container = document.getElementById('tengah');

            const aspectRatio = 720 / 1098;

            function calculateCanvasSize() {
                const containerStyle = window.getComputedStyle(container);
                // get padding
                const paddingLeft = parseFloat(containerStyle.paddingLeft) || 0;
                const paddingRight = parseFloat(containerStyle.paddingRight) || 0;
                let availableWidth = Math.max(0, container.clientWidth - paddingLeft - paddingRight);

                const winW = window.innerWidth;
                let targetWidth;
                if (winW >= 1280) { // xl
                    targetWidth = Math.min(availableWidth, 1098);
                } else if (winW >= 1024) { // lg
                    targetWidth = Math.min(availableWidth, 980);
                } else if (winW >= 768) { // md
                    targetWidth = Math.min(availableWidth, 720);
                } else if (winW >= 640) { // sm
                    targetWidth = Math.min(availableWidth, 540);
                } else {
                    targetWidth = Math.min(availableWidth, 183);
                }

                const minWidth = 366;
                const maxWidth = 1098;
                if (targetWidth < minWidth) targetWidth = minWidth;
                if (targetWidth > maxWidth) targetWidth = maxWidth;

                const targetHeight = Math.round(targetWidth * aspectRatio);
                return { width: Math.round(targetWidth), height: targetHeight };
            }

            function initCanvas() {
                const size = calculateCanvasSize();
                currentCanvasWidth = size.width;
                currentCanvasHeight = size.height;

                canvasEl.width = currentCanvasWidth;
                canvasEl.height = currentCanvasHeight;
                canvasEl.style.width = currentCanvasWidth + 'px';
                canvasEl.style.height = currentCanvasHeight + 'px';

                canvas = new fabric.Canvas('canvas-bg', {
                    backgroundColor: null,
                    selection: true,
                    preserveObjectStacking: true
                });
            }

            initCanvas();

            // Load background mockup
            fabric.Image.fromURL("{{ asset('images/mockup-tshirt.png') }}", function(img) {
                img.filters = [];

                bgImageRef = img;

                const scaleX = currentCanvasWidth / img.width;
                const scaleY = currentCanvasHeight / img.height;
                const scale = Math.max(scaleX, scaleY);
                img.scale(scale);
                img.set({ left: (currentCanvasWidth - img.getScaledWidth()) / 2, top: (currentCanvasHeight - img.getScaledHeight()) / 2, selectable: false, evented: false });
                canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));

                function resizeCanvas() {
                    const newSize = calculateCanvasSize();
                    const newW = newSize.width;
                    const newH = newSize.height;

                    if (newW === currentCanvasWidth && newH === currentCanvasHeight) return;

                    const scaleX = newW / currentCanvasWidth;
                    const scaleY = newH / currentCanvasHeight;
                    const scale = Math.min(scaleX, scaleY);

                    canvasEl.width = newW;
                    canvasEl.height = newH;
                    canvasEl.style.width = newW + 'px';
                    canvasEl.style.height = newH + 'px';

                    // scale all objects on canvas
                    canvas.getObjects().forEach(function(obj) {
                        // skip background image (it's handled separately)
                        if (obj === bgImageRef) return;
                        obj.scaleX = (obj.scaleX || 1) * scaleX;
                        obj.scaleY = (obj.scaleY || 1) * scaleY;
                        obj.left = obj.left * scaleX;
                        obj.top = obj.top * scaleY;
                        obj.setCoords();
                    });

                    // rescale background image to cover new canvas size
                    if (bgImageRef) {
                        const img = bgImageRef;
                        const sX = newW / img.width;
                        const sY = newH / img.height;
                        const s = Math.max(sX, sY);
                        img.scale(s);
                        img.set({ left: (newW - img.getScaledWidth()) / 2, top: (newH - img.getScaledHeight()) / 2 });
                        canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
                    } else {
                        canvas.renderAll();
                    }

                    // update current size
                    currentCanvasWidth = newW;
                    currentCanvasHeight = newH;
                }

                // Debounced resize listener
                let resizeTimer = null;
                window.addEventListener('resize', function() {
                    if (resizeTimer) clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                        resizeCanvas();
                    }, 150);
                });

                // Add color picker control to the propertiObj div
                const colorPickerContainer = document.createElement('div');
                colorPickerContainer.className = 'p-2 space-y-2';
                colorPickerContainer.innerHTML = `
                <label class="block text-sm font-medium">Warna T-Shirt:</label>
                <div class="grid grid-cols-3 gap-2">
                    <button class="w-full h-8 rounded bg-white text-gray-800 text-xs border border-gray-300 ring-2 ring-blue-500 ring-offset-2" data-color="default">Putih</button>
                    <button class="w-full h-8 rounded bg-black text-white text-xs" data-color="#000000" data-alpha="0.85" data-mode="tint">Hitam</button>
                    <button class="w-full h-8 rounded bg-red-600 text-white text-xs" data-color="#dc2626" data-alpha="0.7" data-mode="tint">Merah</button>
                    <button class="w-full h-8 rounded bg-blue-500 text-white text-xs" data-color="#3b82f6" data-alpha="0.7" data-mode="tint">Biru</button>
                    <button class="w-full h-8 rounded bg-green-500 text-white text-xs" data-color="#22c55e" data-alpha="0.7" data-mode="tint">Hijau</button>
                    <button class="w-full h-8 rounded bg-yellow-500 text-xs" data-color="#facc15" data-alpha="0.7" data-mode="tint">Kuning</button>
                </div>
                `;

                const kiri = document.getElementById('kiri');
                kiri.insertBefore(colorPickerContainer, kiri.firstChild);

                // Function to reset to default white t-shirt
                // untuk reset warna sesuai default (pada mockup)
                function resetToDefault() {
                    img.filters = [];
                    img.applyFilters();
                    canvas.renderAll();
                }

                // Function to apply color filter to the t-shirt
                // untuk menerapkan filter warna
                function applyColorToShirt(color, alpha = 0.5, mode = 'tint') {
                    const filter = new fabric.Image.filters.BlendColor({
                        color: color,
                        mode: mode,
                        alpha: alpha
                    });

                    img.filters = [filter];
                    img.applyFilters();
                    canvas.renderAll();
                }

                // Add click event listeners to color buttons
                colorPickerContainer.querySelectorAll('button').forEach(button => {
                    button.addEventListener('click', (e) => {
                        // Remove active state from all buttons
                        colorPickerContainer.querySelectorAll('button').forEach(btn => {
                            btn.classList.remove('ring-2', 'ring-blue-500',
                                'ring-offset-2');
                        });

                        // Add active state to clicked button
                        e.target.classList.add('ring-2', 'ring-blue-500', 'ring-offset-2');

                        // Check if this is the default white button
                        if (e.target.dataset.color === 'default') {
                            resetToDefault();
                        } else {
                            const color = e.target.dataset.color;
                            const alpha = parseFloat(e.target.dataset.alpha) || 0.5;
                            const mode = e.target.dataset.mode || 'tint';
                            applyColorToShirt(color, alpha, mode);
                        }
                    });
                });

                const targetAreaA3 = {
                    left: 720,
                    top: 210,
                    right: 940,
                    bottom: 565,
                    harga: 45000
                };

                const targetAreaLogo = {
                    left: 300,
                    top: 235,
                    right: 380,
                    bottom: 310,
                    harga: 10000
                };

                const targetArea21cm = {
                    left: 650,
                    top: 100,
                    right: 1000,
                    bottom: 600,
                    price: 100000
                };

                const boundaryAreaA3 = new fabric.Rect({
                    left: targetAreaA3.left,
                    top: targetAreaA3.top,
                    width: targetAreaA3.right - targetAreaA3.left,
                    height: targetAreaA3.bottom - targetAreaA3.top,
                    fill: 'rgba(0, 0, 0, 0)',
                    stroke: 'red',
                    strokeWidth: 2,
                    opacity: 0.5,
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
                    opacity: 0.5,
                    strokeDashArray: [5, 5],
                    selectable: false
                });
                canvas.add(boundaryAreaLogo);

                canvas.on('selection:created', function() {
                    divHapus.classList.remove("hidden");
                    propertiObj.classList.remove("hidden");
                });

                canvas.on("selection:created", function(e) {
                    let totalPrice = 0;
                    let isAnyObjectInArea = false;

                    canvas.getActiveObjects().forEach(function(obj) {
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


                canvas.on("object:moving", function(e) {
                    let totalPrice = 0;
                    let isAnyObjectInArea = false;
                    targetAreaA3.opacity = 0.5;
                    targetAreaLogo.opacity = 0.5;

                    canvas.getObjects().forEach(function(obj) {
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

                document.getElementById("newText").addEventListener("click", function() {
                    const newText = new fabric.Textbox("Masukkan teks di sini", {
                        left: 100,
                        top: 100,
                        fill: "black",
                    });

                    canvas.add(newText);

                    priceElement.classList.add("hidden");
                    priceElement.textContent = "";
                });

                document.getElementById("uploadImg").addEventListener("change", function(e) {
                    var file = e.target.files[0];
                    var reader = new FileReader();
                    reader.onload = function(f) {
                        var data = f.target.result;
                        fabric.Image.fromURL(data, function(img) {
                            img.set({
                                left: 0,
                                top: 0,
                                angle: 0
                            });
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
                    const dataURL = canvas.toDataURL({
                        format: 'jpeg',
                        quality: 1
                    });
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
                        document.getElementById('fontFamily').addEventListener('change', function(
                            e) {
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
                            activeObj.set('fontWeight', activeObj.fontWeight === 'bold' ?
                                'normal' : 'bold');
                            canvas.renderAll();
                        });

                        document.getElementById('italicText').addEventListener('click', function() {
                            activeObj.set('fontStyle', activeObj.fontStyle === 'italic' ?
                                'normal' : 'italic');
                            canvas.renderAll();
                        });

                        document.getElementById('underlineText').addEventListener('click',
                            function() {
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

                canvas.getObjects().forEach(function(obj) {
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
            const hargaSablon = document.getElementById('price').textContent.replace('Rp. ', '').replace(/\./g, '').replace(
                ',', '').trim();
            localStorage.setItem('hargaSablon', hargaSablon || '0');
        }

        // Simpan mockup sementara
        function saveMockupImage() {
            if (canvas instanceof fabric.Canvas) {
                try {
                    // Hide boundary areas temporarily
                    const boundaryAreaA3 = canvas.getObjects().find(obj => obj.type === 'rect' && obj.stroke === 'red');
                    const boundaryAreaLogo = canvas.getObjects().find(obj => obj.type === 'rect' && obj.stroke === 'blue');

                    if (boundaryAreaA3) boundaryAreaA3.visible = false;
                    if (boundaryAreaLogo) boundaryAreaLogo.visible = false;

                    canvas.renderAll();

                    // Generate mockup image with proper MIME type
                    const mockupImage = canvas.toDataURL({
                        format: 'png',
                        quality: 1,
                        multiplier: 1
                    });

                    // Store in localStorage with error checking
                    try {
                        localStorage.setItem('mockupImage', mockupImage);
                    } catch (e) {
                        console.error('Error saving to localStorage:', e);
                        // Handle localStorage errors (e.g., quota exceeded)
                        alert('Gagal menyimpan mockup. File mungkin terlalu besar.');
                        return false;
                    }

                    // Restore boundary areas visibility
                    if (boundaryAreaA3) boundaryAreaA3.visible = true;
                    if (boundaryAreaLogo) boundaryAreaLogo.visible = true;
                    canvas.renderAll();

                    return true;
                } catch (e) {
                    console.error('Error generating mockup:', e);
                    alert('Gagal membuat mockup image');
                    return false;
                }
            }
            return false;
        }

        // Tambahkan onclick ke tombol Pesan dengan penanganan error
        document.querySelector('a[href="{{ route('orderTshirt') }}"]').addEventListener('click', function(event) {
            event.preventDefault();

            const saveSuccess = saveMockupImage();
            if (saveSuccess) {
                simpanHargaSablon();
                window.location.href = "{{ route('orderTshirt') }}";
            }
        });
</script>
@endpush
