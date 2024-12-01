@extends('layouts.layout')

@section('title', 'Pesan - DMCO')

@section('content')
    <div class="flex justify-center min-h-screen py-8 bg-gray-100">
        <div class="max-w-4xl w-full bg-white shadow-md rounded-lg p-8">
            <h1 class="text-3xl font-bold text-[#3FA3FF] mb-2">Pesan</h1>
            <p class="text-gray-600 mb-6">Siapkan informasi pembayaran untuk melanjutkan pesanan</p>
            <div class="bg-gray-50 p-6 rounded-lg border">
                <h2 class="text-lg font-bold mb-4">Ukuran</h2>
                <div class="grid grid-cols-2 gap-8">
                    <!-- Lengan Pendek -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Lengan Pendek</h3>
                        <div class="grid grid-cols-5 gap-4">
                            @foreach (['M', 'L', 'XL', 'XXL'] as $size)
                                <div class="flex flex-col items-center">
                                    <span class="text-sm font-medium">{{ $size }}</span>
                                    <input type="number" value="0" min="0"
                                        class="size-input w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300"
                                        data-weight="170" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Lengan Panjang -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Lengan Panjang</h3>
                        <div class="grid grid-cols-5 gap-4">
                            @foreach (['M', 'L', 'XL', 'XXL'] as $size)
                                <div class="flex flex-col items-center">
                                    <span class="text-sm font-medium">{{ $size }}</span>
                                    <input type="number" value="0" min="0"
                                        class="size-input w-16 h-10 border rounded-md text-center focus:outline-none focus:ring focus:ring-blue-300"
                                        data-weight="170" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <!-- Nama Input -->
                <div class="mb-4">
                    <label for="name" class="block font-medium">Nama</label>
                    <input type="text" id="name" placeholder="Masukan nama penerima"
                        class="w-full border rounded-md h-10 px-3 mt-2 focus:outline-none focus:ring focus:ring-blue-300" />
                </div>

                <!-- Alamat Tujuan -->
                <div class="mb-4 bg-gray-50 p-6 rounded-lg border">
                    <p class="text-[14px] text-[#3FA3FF]">Dikirim Dari:
                        <span id="origin-city">{{ $cities[$defaultCityId] }}, {{ $provinces[$defaultProvinceId] }}</span>
                    </p>
                    <h3 class="text-lg font-bold mb-4">Alamat Tujuan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium">Provinsi Tujuan</label>
                            <select id="province_destination" name="province_destination"
                                class="w-full border rounded-md h-10 px-3 mt-2 focus:outline-none focus:ring focus:ring-blue-300">
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $province_id => $province_name)
                                    <option value="{{ $province_id }}">{{ $province_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-medium">Kota/Kabupaten Tujuan</label>
                            <select id="city_destination" name="city_destination"
                                class="w-full border rounded-md h-10 px-3 mt-2 focus:outline-none focus:ring focus:ring-blue-300">
                                <option value="">Pilih Kota/Kabupaten</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Berat & Kurir -->
                <div class="mb-6 bg-gray-50 p-6 rounded-lg border relative">
                    <h3 class="text-lg font-bold mb-4">Pilih Kurir</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex space-x-4" id="courier">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="courier" value="jne" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <img src="{{ asset('/images/logo_jne.png') }}" class="w-[110px] h-12 object-contain">
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="courier" value="pos" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <img src="{{ asset('/images/logo_pos.png') }}" class="w-[110px] h-12 object-contain">
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="courier" value="tiki" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <img src="{{ asset('/images/logo_tiki.png') }}" class="w-[120px] h-12 object-contain">
                            </label>
                        </div>
                    </div>
                    <!-- Berat -->
                    <div class="absolute bottom-4 right-4 text-gray-700">
                        <span class="font-medium">Berat:</span>
                        <span id="weight-display" class="font-bold">0</span> <span>gram</span>
                    </div>
                </div>
                <!-- Tombol Cek Ongkir -->
                <div class="flex justify-end">
                    <button id="check_shipping"
                        class="bg-[#3FA3FF] text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-500 transition">
                        Cek Ongkir
                    </button>
                </div>

                <!-- Ongkir -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card d-none ongkir">
                            <div class="card-body">
                                <ul class="list-group" id="ongkir"></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="mb-4">
                <label for="address" class="block font-medium">Alamat Lengkap</label>
                <textarea id="address" placeholder="Masukan alamat penerima"
                    class="w-full border rounded-md h-20 px-3 py-2 mt-2 focus:outline-none focus:ring focus:ring-blue-300"></textarea>
                <div class="text-left text-gray-500 mt-4">
                    <p class="text-[12px] text-red-500"><i>Alamat Lengkap berupa : Nama jalan / blok / gang / no.rumah -
                            desa & kecamatan</i></p>
                </div>
            </div>
            <hr>
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-medium text-gray-700">Harga Produk</span>
                    <span class="font-bold text-gray-900">Rp
                        {{ number_format($catalogs->first()->price, 0, ',', '.') }}</span>
                </div>
                <hr>
                <div class="flex justify-between items-center mb-2">
                    <span class="font-medium text-gray-700">Harga Jasa</span>
                    <span class="font-bold text-gray-900">Rp 50.000</span>
                </div>
                <hr>
                <div class="flex justify-between items-center">
                    <span class="font-medium text-gray-700">Total Harga</span>
                    <h4>Rp <span class="font-bold text-[#3FA3FF]" id="total-price">0</span></h4>
                </div>
                <hr>
                <div class="flex justify-end mt-5">
                    <a href="#"
                        class="bg-[#3FA3FF] text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-500 transition">
                        Bayar
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection






{{-- ================= JAVASCRIPT ORDER & CEK ONGKIR ================ --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const provinceDropdown = document.getElementById("province_destination");
    const cityDropdown = document.getElementById("city_destination");
    const checkShippingButton = document.getElementById("check_shipping");
    const ongkirContainer = document.querySelector(".ongkir");
    const ongkirList = document.getElementById("ongkir");
    const totalPriceElement = document.getElementById("total-price");
    const weightDisplay = document.getElementById("weight-display");

    // Harga produk dan harga jasa
    const productTotal = {{ $catalogs->first()->price }};
    const serviceFee = 50000;
    const defaultWeightPerSize = 170; // Berat default per ukuran (gram)
    const sizeInputs = document.querySelectorAll('.size-input');

    // Fungsi untuk menghitung berat total berdasarkan ukuran
    function calculateTotalWeight() {
        let totalWeight = 0;
        sizeInputs.forEach(input => {
            const quantity = parseInt(input.value) || 0;
            totalWeight += quantity * defaultWeightPerSize;
        });
        weightDisplay.textContent = totalWeight; // Tampilkan berat sebagai teks
        return totalWeight; // Kembalikan total berat
    }

    // Fungsi untuk menghitung total harga (produk + jasa + ongkir)
    function updateTotalPrice(ongkirPrice) {
        const totalWeight = calculateTotalWeight(); // Pastikan berat diperbarui
        const totalPrice = productTotal + serviceFee + ongkirPrice;
        totalPriceElement.textContent = totalPrice.toLocaleString();
    }

    // Perbarui berat saat jumlah ukuran berubah
    sizeInputs.forEach(input => {
        input.addEventListener('input', calculateTotalWeight);
    });

    // Fetch cities when province is selected
    if (provinceDropdown && cityDropdown) {
        provinceDropdown.addEventListener("change", function () {
            const provinceId = this.value;

            cityDropdown.innerHTML = '<option value="">Pilih Kota/Kabupaten</option>';

            if (provinceId) {
                fetch(`/cities/${provinceId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        Object.entries(data).forEach(([key, value]) => {
                            const option = document.createElement("option");
                            option.value = key;
                            option.textContent = value;
                            cityDropdown.appendChild(option);
                        });
                    })
                    .catch((error) => console.error("Error fetching cities:", error));
            }
        });
    }

    if (checkShippingButton) {
        checkShippingButton.addEventListener("click", function (e) {
            e.preventDefault();

            const provinceId = provinceDropdown.value;
            const cityId = cityDropdown.value;
            const courier = document.querySelector('input[name="courier"]:checked')?.value;
            const weight = calculateTotalWeight(); // Dapatkan total berat

            // Validate inputs
            if (!provinceId || !cityId) {
                alert("Silakan pilih provinsi dan kota tujuan terlebih dahulu.");
                return;
            }

            if (!courier) {
                alert("Silakan pilih kurir.");
                return;
            }

            if (weight <= 0) {
                alert("Silakan masukkan jumlah ukuran untuk menghitung berat pengiriman.");
                return;
            }

            // Get CSRF token (assuming it's available in a meta tag)
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

            const cityOrigin = "{{ $defaultCityId }}";

            fetch("/order/t-shirt", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token
                },
                body: JSON.stringify({
                    city_origin: cityOrigin,
                    city_destination: cityId,
                    courier: courier,
                    weight: weight
                })
            })
                .then(response => response.json())
                .then(data => {
                    ongkirList.innerHTML = "";
                    ongkirContainer.classList.remove("d-none");
                    ongkirContainer.classList.add("d-block");

                    data[0].costs.forEach((costOption, index) => {
                        const listItem = document.createElement("li");
                        listItem.classList.add("list-group-item");
                        listItem.innerHTML = `
                    <input type="radio" name="shipping_option" value="${index}" id="shipping_${index}" class="shipping-option-radio">
                    <label for="shipping_${index}">
                        ${data[0].code.toUpperCase()} : 
                        <strong>${costOption.service}</strong> - 
                        Rp. ${costOption.cost[0].value} 
                        (${costOption.cost[0].etd} Hari)
                    </label>
                `;
                        ongkirList.appendChild(listItem);
                    });

                    const shippingOptions = document.querySelectorAll('.shipping-option-radio');
                    shippingOptions.forEach(option => {
                        option.addEventListener('change', function () {
                            const selectedOption = data[0].costs[this.value];
                            const shippingPrice = selectedOption.cost[0].value;
                            updateTotalPrice(shippingPrice);
                        });
                    });
                })
                .catch(error => {
                    console.error("Error checking shipping costs:", error);
                    alert("Terjadi kesalahan saat memeriksa ongkir. Silakan coba lagi.");
                });
        });
    }

    // Hitung berat dan total harga awal
    calculateTotalWeight();
    updateTotalPrice(0);
});
</script>

