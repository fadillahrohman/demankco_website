<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'status',
        'payment_status',
        'user_id',
        'name',
        'email',
        'phone_number',
        'number_of_orders',
        'list_size',
        'total_price',
        'address',
        'courier',
        'weight',
        'province_destination',
        'city_destination',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            // Membuat order_id unik
            $order->order_id = 'DMCO' . mt_rand(10000000, 99999999); // Menghasilkan angka acak 8 digit

        });
    }

    /**
     * Mendefinisikan relasi dengan order item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Order_item::class);
    }

    /**
     * Mendefinisikan relasi dengan payment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Relasi ke Province
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_destination');
    }

    // Relasi ke City
    public function city()
    {
        return $this->belongsTo(City::class, 'city_destination');
    }

}
