<?php

namespace App\Models;

class OrderDetail extends BaseModel
{
    protected $table = 'order_details';
    protected $primaryKey = 'order_detail_id';

    const UPDATED_AT = null;

    protected $fillable = [
        'booking_room_id',
        'booking_service_id',
        'order_id',
        'note',
        'quantity',
        'unit_price',
        'line_total',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'line_total' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function bookingRoom()
    {
        return $this->belongsTo(BookingRoom::class, 'booking_room_id', 'booking_room_id');
    }

    public function bookingServicePet()
    {
        return $this->belongsTo(BookingServicePet::class, 'booking_service_id', 'booking_service_id');
    }
}
