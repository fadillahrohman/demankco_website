@extends('layouts.layout')

@section('title', 'Katalog - DMCO')

@section('content')
<div class="justify-items-left mb-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <h1 class="text-3xl font-semibold mb-4 text-[#3FA3FF]">Pesanan</h1>
      <p class="text-gray-600 mb-8">Cek status pesanan kamu di sini</p>

    <div class="flex w-auto outline outline-1 outline-slate-300 rounded-lg">
        <table class="table-fixed p-48">
            <thead class="bg-slate-100">
                <tr>
                    <th>nama</th>
                    <th>alamat</th>
                    <th>status</th>
                    <th>tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="justify-items-center">
                    <td>rayhan ganteng</td>
                    <td>Arab</td>
                    <td>Diproses</td>
                    <td>12 - 11 - 2024</td>
                    <button type="button">Hapus</button>
                </tr>
                <tr>
                    <td>Rohman</td>
                    <td>Jatibarang, Indramayu</td>
                    <td>Dikirim</td>
                    <td>13 - 11 - 2024</td>
                </tr>
                <tr>
                    <td>Gugun</td>
                    <td>Pabean, Indramayu</td>
                    <td>Selesai</td>
                    <td>14 - 12 - 2024</td>
                </tr>
                <tr>
                    <td>Rayhan</td>
                    <td>Mars</td>
                    <td>Ditolak</td>
                    <td>12 - 11 - 2045</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection