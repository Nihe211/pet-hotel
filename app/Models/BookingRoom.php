<?php

namespace App\Models;

class BookingRoom extends BaseModel
{
    protected $table = 'booking_room';
    protected $primaryKey = 'booking_room_id';

    // CHỈNH SỬA BƯỚC 4: bảng booking_room không có created_at/updated_at.
    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'room_id',
        'assigned_at',
        'note',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function bookingRoomPets()
    {
        return $this->hasMany(BookingRoomPet::class, 'booking_room_id', 'booking_room_id');
    }

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'booking_room_pet', 'booking_room_id', 'pet_id')
            ->withPivot('assigned_at', 'note');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'booking_room_id', 'booking_room_id');
    }
}
