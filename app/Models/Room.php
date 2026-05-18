<?php

namespace App\Models;

class Room extends BaseModel
{
    protected $table = 'room';
    protected $primaryKey = 'room_id';

    protected $fillable = [
        'branch_id',
        'type_room_id',
        'room_number',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function typeRoom()
    {
        return $this->belongsTo(TypeRoom::class, 'type_room_id', 'type_room_id');
    }

    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class, 'room_id', 'room_id');
    }

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_room', 'room_id', 'booking_id')
            ->withPivot('booking_room_id', 'assigned_at', 'note');
    }
}
