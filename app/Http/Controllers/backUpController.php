<?php

namespace App\Http\Controllers;
use App\Models\Order_item;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
class backUpController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderTshirt()
    {
        $catalogs = Catalog::where('type', 'Tshirt')->get();

        $provinces = Province::pluck('name', 'province_id');
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu

        // $defaultWeight = 170; // Default Berat (Gram)

        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');


        return view('orders.orderTshirt', compact('catalogs', 'provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));

    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended(route('orderTshirt')); // Redirect setelah login
    }

    public function orderCrewneck()
    {
        $catalogs = Catalog::where('type', 'Crewneck')->get();
        $provinces = Province::pluck('name', 'province_id');
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu

        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');


        return view('orders.orderCrewneck', compact('catalogs', 'provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
    }

    public function orderHoodie()
    {
        $catalogs = Catalog::where('type', 'Hoodie')->get();
        $provinces = Province::pluck('name', 'province_id');
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu

        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');


        return view('orders.orderHoodie', compact('catalogs', 'provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
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
            'origin' => $request->city_origin, // ID kota/kabupaten asal
            'destination' => $request->city_destination, // ID kota/kabupaten tujuan
            'weight' => $request->weight, // berat barang dalam gram
            'courier' => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos']
        ])->get();

        return response()->json($cost);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'province_destination' => 'required|exists:provinces,id',
            'city_destination' => 'required|exists:cities,id',
            'address' => 'required|string|max:500',
            'courier' => 'required|string',
            'sizes' => 'required|array',
            'sizes.*' => 'integer|min:0', 
            'total_price' => 'required|numeric',
        ]);
    
        // Simpan data Order
        $order = Order::create([
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'name' => $validated['name'],
            'number_of_orders' => array_sum($validated['sizes']),
            'list_size' => json_encode($validated['sizes']),
            'total_price' => $validated['total_price'],
            'address' => $validated['address'],
            'courier' => $validated['courier'],
            'weight' => array_sum(array_map(fn($qty) => $qty * 170, $validated['sizes'])),
            'province_destination' => $validated['province_destination'],
            'city_destination' => $validated['city_destination'],
        ]);
    
        // Simpan Order Items dari data order yang baru saja dibuat
        Order_item::create([
            'order_id' => $order->id,
            'product_name' => $order->name, 
            'price' => $order->total_price, 
            'quantity' => $order->number_of_orders,
        ]);
    
        return redirect()->route('orders.success', ['order' => $order->id])
            ->with('success', 'Pesanan berhasil dibuat!');
    }
    
    
}
