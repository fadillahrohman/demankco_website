<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Catalog;

use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
class OrderController extends Controller
{
/**
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function orderTshirt() {
        $catalogs = Catalog::where('type', 'Tshirt')->get();

        $provinces = Province::pluck('name', 'province_id');
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu
        // $defaultWeight = 170; // Default Berat (Gram)

        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');
        
        return view('orders.orderTshirt', compact('catalogs','provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
        
    }

    public function orderCrewneck() {
        $catalogs = Catalog::where('type', 'Crewneck')->get(); 

        $provinces = Province::pluck('name', 'province_id');
        
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu

        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');
        

        return view('orders.orderCrewneck', compact('catalogs','provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
    }

    public function orderHoodie() {
        $catalogs = Catalog::where('type', 'Hoodie')->get();

        $provinces = Province::pluck('name', 'province_id');
        
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu

        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');
        
       
        return view('orders.orderHoodie', compact('catalogs','provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
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
