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
  <div id="kiri" class="grid-rows-auto h-fit w-fit justify-items-center space-y-2 rounded-lg bg-white p-2 shadow-lg hover:divide-solid outline outline-1 outline-slate-100">
    <div class="rounded-lg bg-slate-50 outline outline-1 outline-slate-200 space-1">
      <button id="newText" class="flex w-full items-center gap-x-2 rounded-lg px-4 py-2 justify-center text-lg text-slate-700 transition duration-300 hover:bg-slate-200"><i class="fa-regular fa-i"></i> Teks</button>
      <form class="flex flex-col">
        <label for="uploadImg" class="w-full cursor-pointer justify-center rounded-lg px-4 py-2 text-lg text-slate-700 hover:bg-slate-200"><i class="fa-solid fa-image"></i> Gambar</label>
        <input type="file" id="uploadImg" class="hidden" multiple onchange="handleFiles(this)" />
        <ul id="fileList" class="mt-2 list-disc text-black"></ul>
      </form>
      <button id="downImg" class="flex w-full items-center gap-x-2 rounded-lg px-4 py-2 justify-center text-lg text-slate-700 transition duration-300 hover:bg-slate-200"><i class="fa-solid fa-download"></i>  Simpan</button>
    </div>

    <button class="justify-center flex w-full rounded-lg bg-blue-500 px-4 py-2 text-lg font-medium text-white transition duration-300 hover:bg-blue-600 hover:text-white">
      <a href="{{ route('orderHoodie') }}">Pesan</a>
    </button>
    <button class="justify-center flex w-full rounded-lg px-4 py-2 text-lg text-slate-700 outline outline-1 outline-slate-200 transition duration-300 hover:bg-slate-200">
      <a href="{{ route('catalogs.list') }}">Kembali</a>
    </button>
    <div id="divHapus" class="hidden justify-self-center rounded-lg bg-red-500 px-4 py-2 text-lg font-medium text-white transition duration-300 hover:bg-red-600 hover:text-white shadow-lg">
      <button id="hapusObj" type="button" onclick="delObj()">Hapus</button>
    </div>
    <div id="price" class="hidden flex text-lg font-bold text-green-500 mt-4 px-4 py">Harga: Rp. 150,000</div>


  </div>

  <div id="tengah" class="rounded-lg bg-green-200 shadow-lg pt-6">
    <canvas id="canvas-bg" width="1098" height="720">canvas</canvas>
  </div>
</div>

<div class="pt-10"></div>
@endsection

@push('fabric_scripts')
  <script>
    // Inisialisasi canvas fabric.js
    let canvas = new fabric.Canvas("canvas-bg", { 
        backgroundImage: "{{ asset('images/mockup-tshirt.png') }}",
        scaleToHeight: 720,
        scaleToWidth: 1098,
    });

    // Area batas sablon (merah dan biru)
    const targetAreaRed = {
        left: 650, top: 100, right: 1000, bottom: 600, price: 100000
    };
    const targetAreaBlue = {
        left: 100, top: 100, right: 500, bottom: 600, price: 75000
    };

    // Gambar batas area merah
    const boundaryRed = new fabric.Rect({
        left: targetAreaRed.left,
        top: targetAreaRed.top,
        width: targetAreaRed.right - targetAreaRed.left,
        height: targetAreaRed.bottom - targetAreaRed.top,
    fill: 'rgba(0, 0, 0, 0)',
    stroke: 'red',            
    strokeWidth: 2,           
    selectable: false         
});
canvas.add(boundaryRed);

// Gambar batas area biru
const boundaryBlue = new fabric.Rect({
    left: targetAreaBlue.left,
    top: targetAreaBlue.top,
    width: targetAreaBlue.right - targetAreaBlue.left,
    height: targetAreaBlue.bottom - targetAreaBlue.top,
    fill: 'rgba(0, 0, 0, 0)',
    stroke: 'blue',   
    strokeWidth: 2,  
    selectable: false      
});
canvas.add(boundaryBlue);

const priceElement = document.getElementById("price");
// Fungsi cek apa objek ada di dalam area
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

// Update harga berdasarkan posisi objek
canvas.on('object:moving', function(e) {
    let totalPrice = 0;

    canvas.getObjects().forEach(function(obj) {

      if (isObjectInArea(obj, targetAreaRed)) {
        totalPrice += targetAreaRed.price;
    }
    else if (isObjectInArea(obj, targetAreaBlue)) {
      totalPrice += targetAreaBlue.price;
  }

  else {
    totalPrice = 0
  }
});

// Tampilkan harga
if (totalPrice > 0) {
  priceElement.classList.remove("hidden");
  priceElement.textContent = "Harga: Rp. " + totalPrice.toLocaleString();
} else {
  priceElement.classList.add("hidden");
}
});

// Tambah teks ke canvas
document.getElementById("newText").addEventListener("click", function() {
const newText = new fabric.Textbox('Masukkan teks di sini', {
    left: 100,
    top: 100,
    fill: 'black'
});

canvas.add(newText);
});

// Tambah gambar ke canvas
document.getElementById('uploadImg').addEventListener("change", function (e) {
var file = e.target.files[0];
var reader = new FileReader();
reader.onload = function (f) {
    var data = f.target.result;                    
    fabric.Image.fromURL(data, function (img) {
        img.set({ left: 0, top: 0, angle: 0 });
        img.scaleToHeight(100);
        img.scaleToWidth(200);
        canvas.add(img).renderAll();
    });
};
reader.readAsDataURL(file);
});

// Download gambar mockup
document.getElementById('downImg').addEventListener('click', function() {
const dataURL = canvas.toDataURL({ format: 'jpeg', quality: 1 });
const link = document.createElement('a');
link.href = dataURL;
link.download = 'Mockup.jpeg';
link.click();
});

// Fungsi hapus objek
function delObj() {
const activeObject = canvas.getActiveObject();
if (activeObject) {
    canvas.remove(activeObject);
    canvas.discardActiveObject().renderAll(); // Update canvas
}
}
</script>


@endpush