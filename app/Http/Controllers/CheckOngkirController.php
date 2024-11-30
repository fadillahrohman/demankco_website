<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CheckOngkirController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $provinces = Province::pluck('name', 'province_id');
        
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu

        // Ambil daftar kota berdasarkan provinsi default
        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');
        
        // Kirimkan data ke view
        return view('ongkir', compact('provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => $request->city_origin, // ID kota/kabupaten asal
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $request->weight, // berat barang dalam gram
            'courier'       => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos']
        ])->get();

        return response()->json($cost);
    }
}