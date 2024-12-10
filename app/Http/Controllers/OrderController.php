<?php

namespace App\Http\Controllers;
use App\Models\Order_item;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
class OrderController extends Controller
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
            // 'notes' => 'nullable|string|max:500',
            'courier' => 'required|string',
            'sizes' => 'required|array',
            'sizes.*' => 'integer|min:0', 
            'total_price' => 'required|numeric|min:0.01',
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
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ),
            'customer_details' => array(
                'first_name' => $order->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();

        return redirect()->route('orderDetail', $order->id);
    }
    
    
}
