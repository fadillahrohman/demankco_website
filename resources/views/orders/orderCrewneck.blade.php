@extends('layouts.layout')

@section('title', 'Pesan - DMCO')

@section('content')
    <div class="flex justify-center min-h-screen py-8 bg-gray-100">
        <div class="max-w-4xl w-full bg-white shadow-md rounded-lg p-8">
            <h1 class="text-3xl font-bold text-[#3FA3FF] mb-2">Pesan</h1>
            <p class="text-gray-600 mb-6">Siapkan informasi pembayaran untuk melanjutkan pesanan</p>
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="mockupImage" id="mockupImage">
                <div class="mb-6">
                    <h2 class="text-lg font-bold mb-4" data-aos="fade-up" data-aos-duration="1000">Preview Desain</h2>
                    <div class="flex justify-center" data-aos="fade-up" data-aos-duration="1300">
                        <img id="mockupPreview" src="" alt="Preview Mockup"
                            class="w-3/4 rounded-lg shadow-md bg-green-300 outline outline-1 outline-slate-200">
                    </div>
                </div>
                <div class="bg-gray-50 p-4 sm:p-6 rounded-lg border relative">
                    <a href="/images/sizechart_crewneck.png" download="sizechart_tshirt.png"
                    class="absolute top-2 right-2 bg-[#3FA3FF] text-white font-semibold px-3 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300"
                        id="openModalButton">
                        <i class="fa-solid fa-cloud-arrow-down text-xl"></i> Size Chart
                    </a>
                    <h2 class="text-lg font-bold mb-4">Ukuran</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-8">
                        <div>
                            <h3 class="font-semibold text-gray-700 mb-2">Crewneck</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 sm:gap-4">
                                @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                    <div class="flex flex-col items-center">
                                        <span class="text-xs sm:text-sm font-medium">{{ $size }}</span>
                                        <input type="number" name="sizes[{{ $size }}]" value="0"
                                            min="0" max="999"
                                            class="size-input w-12 sm:w-16 h-8 sm:h-10 border rounded-md text-center text-xs sm:text-base focus:outline-none focus:ring focus:ring-blue-300"
                                            data-weight="170" />

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <div class="mb-4">
                        <label for="name" class="block font-medium">Nama</label>
                        <input type="text" id="name" name="name" placeholder="Masukkan nama penerima" required
                            class="w-full border rounded-md h-10 px-3 mt-2 focus:outline-slate-300 focus:ring focus:ring-blue-300" />
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block font-medium">No. HP</label>
                        <input type="tel" id="phone_number" name="phone_number" placeholder="Masukkan nama no hp"
                            required maxlength="13"
                            class="w-full border rounded-md h-10 px-3 mt-2 focus:outline-slate-300 focus:ring focus:ring-blue-300"
                            value="{{ old('phone_number', $defaultPhoneNumber) }}" />
                    </div>
                    <!-- Alamat Tujuan -->
                    <div class="mb-4 bg-gray-50 p-6 rounded-lg border">
                        <p class="text-[14px] text-[#3FA3FF]">Dikirim Dari:
                            <span id="origin-city">{{ $cities[$defaultCityId] }},
                                {{ $provinces[$defaultProvinceId] }}</span>
                        </p>
                        <h3 class="text-lg font-bold mb-4">Alamat Tujuan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium">Provinsi Tujuan</label>
                                <select id="province_destination" name="province_destination" required
                                    class="w-full border rounded-md h-10 px-3 mt-2 focus:outline-none focus:ring focus:ring-blue-300">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $province_id => $province_name)
                                        <option value="{{ $province_id }}">{{ $province_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium">Kota/Kabupaten Tujuan</label>
                                <select id="city_destination" name="city_destination" required
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
                                @foreach (['jne' => 'logo_jne.png', 'pos' => 'logo_pos.png', 'tiki' => 'logo_tiki.png'] as $courier => $logo)
                                    <label class="flex items-center space-x-2">
                                        <input type="radio" name="courier" value="{{ $courier }}" required
                                            class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500">
                                        <img src="{{ asset('/images/' . $logo) }}" class="w-[110px] h-12 object-contain">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="absolute bottom-0 right-4 sm:bottom-4 text-gray-700 text-sm sm:text-base">
                            <div class="flex items-center justify-end space-x-2">
                                <span class="font-medium">Berat:</span>
                                <span id="weight-display" class="font-bold">0</span>
                                <span>gram</span>
                            </div>
                        </div>
                    </div>
                    <!-- Tombol Cek Ongkir -->
                    <div class="flex justify-end">
                        <button id="check_shipping" type="button"
                            class="bg-[#3FA3FF] text-white font-semibold px-6 py-2 rounded-md hover:bg-blue-500 transition">
                            Cek Ongkir
                        </button>
                    </div>

                    <!-- Ongkir -->
                    <div class="mt-3 d-none ongkir">
                        <div id="ongkirListVisible" class="hidden bg-white p-4 rounded-lg border">
                            <ul class="list-group" id="ongkir"></ul>
                        </div>
                    </div>
                </div>
                <!-- Alamat Lengkap -->
                <div class="mb-4">
                    <label for="address" class="block font-medium">Alamat Lengkap</label>
                    <textarea id="address" name="address" placeholder="Masukkan alamat penerima" required
                        class="w-full border rounded-md h-20 px-3 py-2 mt-2 focus:outline-none focus:ring focus:ring-blue-300"></textarea>
                    <div class="text-left text-gray-500 mt-4">
                        <p class="text-[12px] text-blue-500"><i>* Alamat Lengkap berupa : Nama jalan / blok / gang /
                                no.rumah - desa & kecamatan</i></p>
                    </div>
                </div>
                <!-- Total Harga -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Harga Produk</span>
                        <span class="font-bold text-gray-900">Rp
                            {{ number_format($catalogs->first()->price, 0, ',', '.') }}</span>
                    </div>
                    <hr>
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-medium text-gray-700">Harga Sablon</span>
                        <input type="hidden" name="type" value="Crewneck">
                        <span class="font-bold text-gray-900" id="harga-sablon">Rp 0</span>
                    </div>
                    <hr>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Total Harga</span>
                        <input type="hidden" id="total-price-input" name="total_price" value="0">
                        <h4 class="font-bold text-[#3FA3FF]">Rp <span class="font-bold text-[#3FA3FF]"
                                id="total-price">0</span></h4>
                    </div>
                    <div class="text-left text-gray-500 mt-4">
                        <p class="text-[12px] text-blue-500"><i>* Harga termasuk PPN 12%</i></p>
                    </div>
                    <hr>
                    <div class="flex justify-end mt-5">
                        <button type="submit"
                            class="w-full bg-[#3FA3FF] text-white text-xl font-semibold px-6 py-2 rounded-md hover:bg-blue-500 transition">
                            Pesan Sekarang
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


{{-- ================= JAVASCRIPT ORDER & CEK ONGKIR ================ --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Load mockup dari localStorage
        const mockupImage = localStorage.getItem('mockupImage');
        if (mockupImage) {
            document.getElementById('mockupImage').value = mockupImage;
            document.getElementById('mockupPreview').src = mockupImage;
        }

        document.querySelectorAll('.size-input').forEach(input => {
            input.addEventListener('input', function() {
                // size input tidak lebih dari 3 digit
                if (this.value.length > 3) {
                    this.value = this.value.slice(0, 3);
                }
            });
        });

        const provinceDropdown = document.getElementById("province_destination");
        const cityDropdown = document.getElementById("city_destination");
        const checkShippingButton = document.getElementById("check_shipping");
        const ongkirContainer = document.querySelector(".ongkir");
        const ongkirList = document.getElementById("ongkir");
        const totalPriceElement = document.getElementById("total-price");
        const weightDisplay = document.getElementById("weight-display");

        // Harga produk (dikirim dari controller)
        const productTotal = {{ $catalogs->first()->price }};
        const defaultWeightPerSize = 170; // Berat default per ukuran (gram)
        const sizeInputs = document.querySelectorAll('.size-input');

        // Ambil harga sablon dari localStorage
        const hargaSablon = parseInt(localStorage.getItem('hargaSablon')) || 0;

        // Update tampilan harga sablon
        const hargaSablonElement = document.getElementById('harga-sablon');
        if (hargaSablonElement) {
            hargaSablonElement.textContent = `Rp ${hargaSablon.toLocaleString()}`;
        }

        function calculateTotalWeight() {
            let totalWeight = 0;
            sizeInputs.forEach(input => {
                const quantity = parseInt(input.value) || 0;
                totalWeight += quantity * defaultWeightPerSize;
            });
            weightDisplay.textContent = totalWeight;
            return totalWeight;
        }

        function calculateTotalItems() {
            let totalItems = 0;
            sizeInputs.forEach(input => {
                totalItems += parseInt(input.value) || 0;
            });
            return totalItems;
        }

        function calculateTotalWeight() {
            let totalWeight = 0;
            sizeInputs.forEach(input => {
                const quantity = parseInt(input.value) || 0;
                totalWeight += quantity * defaultWeightPerSize;
            });
            weightDisplay.textContent = totalWeight;
            return totalWeight;
        }

        // untuk menghitung total harga 
        function updateTotalPrice(ongkirPrice) {
            const totalItems = calculateTotalItems();
            // Hitung harga per item (harga produk + sablon)
            const pricePerItem = productTotal + hargaSablon;
            // Hitung total harga untuk semua barang ditambah ongkos kirim
            const totalPrice = (pricePerItem * totalItems) + ongkirPrice;

            totalPriceElement.textContent = totalPrice.toLocaleString();

            // Update hidden input total price
            const totalPriceInput = document.getElementById("total-price-input");
            totalPriceInput.value = totalPrice;
        }

        // Add input event listeners to recalculate price when quantities change
        sizeInputs.forEach(input => {
            input.addEventListener('input', () => {
                calculateTotalWeight();
                // Get current shipping cost from selected radio button if any
                const selectedShipping = document.querySelector(
                    'input[name="shipping_option"]:checked');
                const currentOngkir = selectedShipping ?
                    parseInt(selectedShipping.closest('li').querySelector('label').textContent
                        .match(/Rp\. (\d+)/)[1]) : 0;
                updateTotalPrice(currentOngkir);
            });
        });

        // Fetch cities when province is selected
        if (provinceDropdown && cityDropdown) {
            provinceDropdown.addEventListener("change", function() {
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
            checkShippingButton.addEventListener("click", function(e) {
                e.preventDefault();

                const provinceId = provinceDropdown.value;
                const cityId = cityDropdown.value;
                const courier = document.querySelector('input[name="courier"]:checked')?.value;
                const weight = calculateTotalWeight();

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

                fetch("/order/crewneck", {
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
                            const show = document.getElementById("ongkirListVisible");
                            listItem.classList.add("list-group-item");
                            show.classList.remove("hidden");
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
                            option.addEventListener('change', function() {
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

        // Hitung berat dan total harga awal (dengan ongkir 0 pada awalnya)
        calculateTotalWeight();
        updateTotalPrice(0);

        // Hapus gambar mockup dari localStorage saat halaman terload semua
        localStorage.removeItem('mockupImage');
    });
</script>
