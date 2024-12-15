<?php

namespace App\Http\Controllers;
use App\Models\Order_item;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Models\Order;
use App\Models\City;
use App\Models\Province;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderTshirt()
    {
        $catalogs = Catalog::where('type', 'Tshirt')->get();

        $user = auth()->user();
        $defaultPhoneNumber = $user->phone_number;

        $provinces = Province::pluck('name', 'province_id');
        $defaultProvinceId = 9; // Default Jawa Barat
        $defaultCityId = 149;   // Default Kab.Indramayu


        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');
        return view('orders.orderTshirt', compact('catalogs', 'defaultPhoneNumber', 'provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));

    }

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended(route('orderTshirt'));
    }

    public function orderCrewneck()
    {
        $catalogs = Catalog::where('type', 'Crewneck')->get();

        $user = auth()->user();
        $defaultPhoneNumber = $user->phone_number;

        $provinces = Province::pluck('name', 'province_id');
        $defaultProvinceId = 9;
        $defaultCityId = 149;
        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');

        return view('orders.orderCrewneck', compact('catalogs', 'defaultPhoneNumber', 'provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
    }

    public function orderHoodie()
    {
        $catalogs = Catalog::where('type', 'Hoodie')->get();

        $user = auth()->user();
        $defaultPhoneNumber = $user->phone_number;

        $provinces = Province::pluck('name', 'province_id');
        $defaultProvinceId = 9;
        $defaultCityId = 149;

        $cities = City::where('province_id', $defaultProvinceId)->pluck('name', 'city_id');

        return view('orders.orderHoodie', compact('catalogs', 'defaultPhoneNumber', 'provinces', 'cities', 'defaultProvinceId', 'defaultCityId'));
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
            'origin' => $request->city_origin,
            'destination' => $request->city_destination,
            'weight' => $request->weight,
            'courier' => $request->courier
        ])->get();

        return response()->json($cost);
    }
    public function store(Request $request)
    {
        try {
            // Validasi input dari pengguna
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'province_destination' => 'required|exists:provinces,id',
                'city_destination' => 'required|exists:cities,id',
                'address' => 'required|string|max:500',
                'phone_number' => 'required|string|min:10|max:15',
                'courier' => 'required|string',
                'sizes' => 'required|array',
                'sizes.*' => 'integer|min:0',
                'total_price' => 'required|numeric',
                'type' => 'required|string|exists:catalogs,type',
            ]);

            $userEmail = auth()->user()->email;
            $userId = auth()->user()->id;

            // Dapatkan nama produk dari tabel catalogs berdasarkan pilihan pengguna
            $catalog = Catalog::where('type', $validated['type'])->firstOrFail();
            $productName = $catalog->name;



            // Simpan data pesanan (Order)
            $order = Order::create([
                'product_name' => $productName,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'name' => $validated['name'],
                'email' => $userEmail,
                'user_id' => $userId,
                'phone_number' => $validated['phone_number'],
                'number_of_orders' => array_sum($validated['sizes']),
                'list_size' => json_encode($validated['sizes']),
                'total_price' => $validated['total_price'],
                'address' => $validated['address'],
                'courier' => $validated['courier'],
                'weight' => array_sum(array_map(fn($qty) => $qty * 170, $validated['sizes'])),
                'province_destination' => $validated['province_destination'],
                'city_destination' => $validated['city_destination'],
            ]);

            // Simpan Order Items (detail pesanan) dari data order yang baru saja dibuat
            Order_item::create([
                'order_id' => $order->id,
                'product_name' => $productName,
                'price' => $order->total_price,
                'quantity' => $order->number_of_orders,
            ]);

            // Redirect ke halaman sukses dengan membawa ID pesanan
            return redirect()->route('orders.success', ['order' => $order->id])
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            Log::error('Error saat membuat pesanan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat pesanan.');
        }
    }

    
}