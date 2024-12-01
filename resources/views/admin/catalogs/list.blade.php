@extends('layouts.admin_layout')

@section('title', 'Katalog - DMCO')

@section('content')

    <body class="bg-gray-50 p-6 font-poppins">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-9">
            @if (Session::has('success'))
                <div class="col-md-10 mt-4">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#3FA3FF]">Katalog</h1>
                <a href="{{ route('admin.catalogs.create') }}"><button class="text-[#3FA3FF] text-5xl">+</button></a>
            </div>
            <div class="bg-white rounded-lg p-4 border-solid border-2 border-gray-200">
                @forelse ($catalogs as $catalog)
                    <div class="flex items-center justify-between pb-4 mb-4  border-gray-300">
                        <div class="flex items-center">
                            <img src="{{ asset('uploads/catalogs/' . $catalog->image) }}"
                                class="w-[7rem] h-[7rem] rounded-md object-cover mr-4" />
                            <div>
                                <h2 class="font-semibold text-lg">{{ $catalog->name }}</h2>
                                <p class="text-gray-400 text-sm">{{ $catalog->stock }}</p>
                                <p class="text-gray-500 font-semibold">Rp. {{ number_format($catalog->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.catalogs.edit', $catalog->id) }}"
                                class="text-[#3FA3FF] text-xl">Edit</a>
                            <form action="{{ route('admin.catalogs.destroy', $catalog->id) }}" method="POST"
                                id="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#FF0303] text-xl">Hapus</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada katalog tersedia.</p>
                @endforelse
            </div>
        </div>


        {{-- JAVASCRIPT NOTIF BERHASIL add/edit/delete --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success'))
            <script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 2000 // Pesan akan hilang setelah 5 detik
                });
            </script>
        @endif
        <script>
            document.getElementById('delete-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form dikirim sebelum konfirmasi

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data katalog ini akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#8FD14F',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim form jika user mengonfirmasi
                        this.submit();
                    }
                });
            });
        </script>

    @endsection
