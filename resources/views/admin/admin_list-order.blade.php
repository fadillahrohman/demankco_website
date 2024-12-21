@extends('layouts.admin_layout')

@section('title', 'Daftar pesanan - DMCO')

@section('content')
    <style>
        /* Modal styling */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.75);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .modal img {
            max-width: 100%;
            /* Gambar mengisi lebar layar */
            max-height: 100%;
            /* Gambar mengisi tinggi layar */
            object-fit: contain;
            /* Menjaga rasio gambar */
        }

        .close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 30px;
            font-weight: bold;
            color: white;
            cursor: pointer;
        }
    </style>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-9">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-[#3FA3FF]">Pesanan</h1>
        </div>
        <div class="flex rows-2 justify-between py-5">
            <h1 class="flex h-auto text-xl text-gray-700 mb-6">Kelola pesanan disini</h1>
            <button
                class="flex w-auto justify-center rounded-lg bg-[#3FA3FF] px-4 py-2.5 text-lg font-medium text-white transition duration-300 hover:bg-blue-500 hover:text-white"
                target="_blank">
                <a href="{{ route('admin.laporan-pdf') }}"><i class="fa-solid fa-download"></i> Download Laporan</a>
            </button>
        </div>

        <div class="bg-white rounded-lg p-4 border-solid border-2 border-gray-200">
            @forelse($order as $orders)
                @if ($orders->payment_status !== 'unpaid')
                    <div class="flex flex-col md:flex-row items-center justify-between pb-4 mb-4 border-gray-300 relative">
                        <div class="flex items-center">
                            <a href="javascript:void(0)"
                                onclick="openModal('{{ asset('uploads/mockups/' . $orders->mockupImage) }}')">
                                <img src="{{ asset('uploads/mockups/' . $orders->mockupImage) }}"
                                    class="w-[7rem] h-[7rem] rounded-md object-contain mr-4 cursor-pointer" />
                            </a>
                            <div>
                                <h2 class="font-semibold text-xl">{{ $orders->product_name }}</h2>
                                <p>Milik : {{ $orders->name }}</p>
                                <p class="text-gray-400 text-[16px]">{{ $orders->order_id }}</p>
                                <p class="text-gray-500 text-[18px] font-semibold">Rp
                                    {{ number_format($orders->total_price, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-4 mt-4 md:mt-0">
                            <a href="{{ route('admin.detail-orders', $orders->id) }}"
                                class="bg-transparent hover:bg-[#3FA3FF] text-[#3FA3FF] hover:text-white font-semibold py-2 px-4 border border-[#3FA3FF] hover:border-transparent rounded text-xl transition-all duration-300 ease-in-out">
                                Detail Pesanan
                            </a>
                            <div class="relative">
                                <button
                                    class="bg-white hover:bg-[#3FA3FF] text-[#3FA3FF] hover:text-white font-semibold py-2 px-4 border border-[#3FA3FF] hover:border-white rounded text-xl transition-all duration-300 ease-in-out"
                                    onclick="toggleDropdown(this)">
                                    Aksi
                                </button>
                                <div
                                    class="absolute z-20 right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg hidden dropdown-menu">
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                        onclick="ubahStatusPesanan('{{ $orders->id }}', 'processing')">Sedang Diproses</a>
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                        onclick="ubahStatusPesanan('{{ $orders->id }}', 'completed')">Selesai</a>
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                        onclick="toggleResiModal('{{ $orders->id }}')">Dikirim</a>
                                    <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100"
                                        onclick="ubahStatusPesanan('{{ $orders->id }}', 'cancelled')">Dibatalkan</a>
                                </div>
                            </div>
                        </div>
                        <div class="relative md:absolute md:bottom-0 right-0 md:mr-4 md:mb-4 mt-4">
                            @if ($orders->status == 'pending')
                                <h2 class="text-gray-500 text-xl">Menunggu Konfirmasi</h2>
                            @elseif($orders->status == 'processing')
                                <h2 class="text-gray-500 text-xl">Sedang Diproses</h2>
                            @elseif($orders->status == 'completed')
                                <h2 class="text-gray-500 text-xl">Selesai</h2>
                            @elseif($orders->status == 'shipped')
                                <h2 class="text-gray-500 text-xl">Dikirim</h2>
                            @elseif($orders->status == 'cancelled')
                                <h2 class="text-gray-500 text-xl">Dibatalkan</h2>
                            @else
                                <h2 class="text-gray-500 text-xl">Menunggu Konfirmasi..</h2>
                            @endif
                        </div>
                    </div>
                @endif
            @empty
                <p class="text-center text-gray-500">Belum ada pesanan tersedia.</p>
            @endforelse
        </div>
    </div>

    <!-- Modal Resi -->
    <div id="resiModal" class="hidden fixed z-30 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Masukkan Nomor Resi</h3>
                    <div class="mt-2">
                        <input type="text" id="resiInput" placeholder="Nomor Resi" class="w-full border rounded p-2">
                        <input type="hidden" id="orderIdInput">
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="submitResi()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#3FA3FF] text-base font-medium text-white hover:bg-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" onclick="closeResiModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk image display -->
    <div id="imageModal" class="modal">
        <span id="closeModal" class="close">&times;</span>
        <img id="modalImage" src="" alt="Gambar Besar" />
    </div>

    <script>
        function openModal(imageSrc) {
            var modal = document.getElementById("imageModal");
            var modalImage = document.getElementById("modalImage");
            modal.style.display = "flex";
            modalImage.src = imageSrc;
        }

        document.getElementById("closeModal").onclick = function() {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none"; // Hide modal
        }


        window.onclick = function(event) {
            var modal = document.getElementById("imageModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function toggleDropdown(button) {
            const dropdown = button.nextElementSibling;
            dropdown.classList.toggle('hidden');
        }

        function toggleResiModal(orderId) {
            // Membuka modal dan mengatur nilai id pesanan
            document.getElementById('resiModal').classList.remove('hidden');
            document.getElementById('orderIdInput').value = orderId;
        }

        function closeResiModal() {
            // Menutup modal
            document.getElementById('resiModal').classList.add('hidden');
        }

        function submitResi() {
            const orderId = document.getElementById('orderIdInput').value; // ID Pesanan
            const resi = document.getElementById('resiInput').value; // Nomor Resi
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // CSRF Token

            // Validasi input resi
            if (!resi.trim()) {
                alert('Nomor resi tidak boleh kosong!');
                return;
            }

            // Kirim permintaan POST dengan fetch
            fetch(`/admin/list-order/${orderId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        status: 'shipped', // Status dikirim
                        receipt: resi // Nomor resi
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Nomor resi berhasil disimpan!');
                        location.reload(); // Refresh halaman setelah berhasil
                    } else {
                        alert(data.message || 'Gagal menyimpan nomor resi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menyimpan nomor resi.');
                });
        }

        function ubahStatusPesanan(orderId, status) {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Kirim permintaan POST untuk mengubah status
            fetch(`/admin/list-order/${orderId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                    },
                    body: JSON.stringify({
                        status: status
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status pesanan berhasil diperbarui.');
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal mengubah status pesanan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat memperbarui status pesanan.');
                });
        }
    </script>




@endsection
