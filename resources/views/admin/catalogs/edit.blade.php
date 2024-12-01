<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Katalog - DMCO</title>
    @vite('resources/css/app.css')

    {{-- GOOGLE FONTS --}}
    {{-- POPPINS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="bg-gray-100 font-poppins">
    <div class="container mx-auto px-4">
        <div class="flex justify-end mt-6">
            <a href="{{ route('admin.catalogs.list') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-lg shadow hover:bg-gray-700">
                <i class="fa-solid fa-backward"></i> Kembali
            </a>
        </div>
        <div class="max-w-4xl mx-auto mt-6">
            <div class="bg-white shadow-lg rounded-lg">
                <div class="bg-gray-800 p-4 rounded-t-lg">
                    <h3 class="text-white text-xl font-semibold">Katalog (edit)</h3>
                </div>
                <form enctype="multipart/form-data" action="{{ route('admin.catalogs.update', $catalog->id) }}"
                    method="post">
                    @method('put')
                    @csrf
                    <div class="p-6">
                        <div class="mb-4">
                            <label for="name" class="block text-lg font-medium text-gray-700">Name</label>
                            <input value="{{ old('name', $catalog->name) }}" type="text" id="name"
                                name="name"
                                class="mt-1 p-5 block w-full border-dashed border-2 border-gray-300 shadow-sm @error('name') text-red-500 @enderror focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Nama Katalog" />
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-lg font-medium text-gray-700">Tipe</label>
                            <select id="type" name="type"
                                class="mt-1 p-5 block w-full border-dashed border-2 border-gray-300 shadow-sm @error('type') text-red-500 @enderror focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled
                                    {{ old('type', $catalog->type) == null ? 'selected' : '' }}>Pilih Tipe Katalog
                                </option>
                                <option value="Tshirt" {{ old('type', $catalog->type) == 'Tshirt' ? 'selected' : '' }}>
                                    T-shirt</option>
                                <option value="Crewneck"
                                    {{ old('type', $catalog->type) == 'Crewneck' ? 'selected' : '' }}>Crewneck</option>
                                <option value="Hoodie" {{ old('type', $catalog->type) == 'Hoodie' ? 'selected' : '' }}>
                                    Hoodie</option>
                            </select>
                            @error('type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-4">
                            <label for="stock" class="block text-lg font-medium text-gray-700">Stok</label>
                            <input value="{{ old('stock', $catalog->stock) }}" type="text" id="stock"
                                name="stock"
                                class="mt-1 p-5 block w-full border-dashed border-2 border-gray-300 shadow-sm @error('stock') text-red-500 @enderror focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Stok" />
                            @error('stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-lg font-medium text-gray-700">Harga Awal</label>
                            <input value="{{ old('price', $catalog->price) }}" type="text" id="price"
                                name="price"
                                class="mt-1 p-5 block w-full border-dashed border-2 border-gray-300 shadow-sm @error('price') text-red-500 @enderror focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Harga" />
                            @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-lg font-medium text-gray-700">Deskripsi</label>
                            <textarea id="description" name="description" rows="5"
                                class="mt-1 p-5 block w-full border-dashed border-2 border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Deskripsi">{{ old('description', $catalog->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-lg font-medium text-gray-700">Image (gambar max:
                                2MB)</label>
                            <input type="file" id="image" name="image"
                                class="mt-1 block w-full border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" />
                            @if ($catalog->image != '')
                                <img class="w-48 mt-3 rounded-lg shadow-md"
                                    src="{{ asset('uploads/catalogs/' . $catalog->image) }}" alt="">
                            @endif
                        </div>

                        <div class="mt-6">
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-3 rounded-lg shadow hover:bg-blue-700">
                                Simpan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
