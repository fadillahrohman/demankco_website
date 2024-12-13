@extends('layouts.admin_layout')

@section('title', 'Daftar pesanan - DMCO')

@section('content')

    <body class="bg-gray-50 p-6 font-poppins">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-9">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#3FA3FF]">Pesanan</h1>
            </div>
            <div class="flex rows-2 justify-between py-5">
                <h1 class="flex h-auto text-xl text-gray-700 mb-6">Cek pesanan kamu disini</h1>
                <button class="flex w-auto justify-center rounded-lg bg-blue-500 px-4 py-2.5 text-lg font-medium text-white transition duration-300 hover:bg-blue-600 hover:text-white" target="_blank">
                    <a href="{{ route("admin.laporan-pdf") }}"><i class="fa-solid fa-download"></i> Download laporan</a>
                </button>
            </div>
          

            <div class="bg-white rounded-lg p-4 border-solid border-2 border-gray-200">
                @forelse($orders as $ordercoy)
                    <div class="flex items-center justify-between pb-4 mb-4 border-gray-300 relative">
                        <div class="flex items-center">
                            <img src="#" class="w-[7rem] h-[7rem] rounded-md object-cover mr-4" />
                            <div>
                                <h2 class="font-semibold text-xl">{{ $ordercoy->product_name }}</h2>
                                <p>Milik: {{ $ordercoy->name }}</p>
                                <p class="text-gray-400 text-[16px]">{{ $ordercoy->order_id }}</p>
                                <p class="text-blue-500 text-[18px] font-semibold">Rp
                                    {{ number_format($ordercoy->total_price, 2, ',', '.') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            
                            <a href="{{ route('customer.orders.show', $ordercoy->id) }}"
                                class="bg-transparent hover:bg-[#3FA3FF] text-[#3FA3FF] hover:text-white font-semibold py-2 px-4 border border-[#3FA3FF] hover:border-transparent rounded text-xl transition-all duration-300 ease-in-out">
                                Detail Pesanan
                            </a>
                            <div class="relative">
                                <button class="bg-white hover:bg-[#3FA3FF] text-[#3FA3FF] hover:text-white font-semibold py-2 px-4 border border-[#3FA3FF] hover:border-white rounded text-xl transition-all duration-300 ease-in-out" onclick="toggleDropdown(this)">
                                    Aksi
                                </button>
                                <div class="absolute z-20 right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-lg hidden">                                    
                                    <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-100" onclick="ubahStatusPesanan('{{ $ordercoy->id }}', 'processing')">Sedang Diproses</a>
                                    <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-100" onclick="ubahStatusPesanan('{{ $ordercoy->id }}', 'completed')">Selesai</a>
                                    <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-100" onclick="ubahStatusPesanan('{{ $ordercoy->id }}', 'shipped')">Dikirim</a>
                                    <a href="" class="block px-4 py-2 text-gray-800 hover:bg-gray-100" onclick="ubahStatusPesanan('{{ $ordercoy->id }}', 'cancelled')">Dibatalkan</a>
                                </div>
                            </div>
                        </div>
                        <div class="absolute bottom-0 right-[-1rem] mb-4 mr-4">
                            @if ($ordercoy->status == 'pending')
                                <h2 class="text-gray-500 text-xl">Menunggu Konfirmasi</h2>
                            @elseif($ordercoy->status == 'processing')
                                <h2 class="text-gray-500 text-xl">Sedang Diproses</h2>
                            @elseif($ordercoy->status == 'completed')
                                <h2 class="text-gray-500 text-xl">Selesai</h2>
                            @elseif($ordercoy->status == 'shipped')
                                <h2 class="text-gray-500 text-xl">Dikirim</h2>
                            @elseif($ordercoy->status == 'cancelled')
                                <h2 class="text-gray-500 text-xl">Dibatalkan</h2>
                            @else
                                <h2 class="text-gray-500 text-xl">Menunggu Konfirmasi..</h2>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada pesanan tersedia.</p>
                @endforelse
            </div>
        </div>

        <script>
            function toggleDropdown(button) {
                const dropdown = button.nextElementSibling;
                dropdown.classList.toggle('hidden');
            }

            function ubahStatusPesanan(orderId, status) {
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/admin/list-order/${orderId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal mengubah status pesanan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
            }
        </script>
@endsection


