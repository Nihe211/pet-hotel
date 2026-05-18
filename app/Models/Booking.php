<?php

namespace App\Models;

class Booking extends BaseModel
{
    protected $table = 'booking';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'customer_id',
        'branch_id',
        'checkin_expected_at',
        'checkout_expected_at',
        'checkin_actual_at',
        'checkout_actual_at',
        'status',
        'note',
    ];

    protected $casts = [
        'checkin_expected_at' => 'datetime',
        'checkout_expected_at' => 'datetime',
        'checkin_actual_at' => 'datetime',
        'checkout_actual_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function bookingRooms()
    {
        return $this->hasMany(BookingRoom::class, 'booking_id', 'booking_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'booking_room', 'booking_id', 'room_id')
            ->withPivot('booking_room_id', 'assigned_at', 'note');
    }

    public function bookingServicesPet()
    {
        return $this->hasMany(BookingServicePet::class, 'booking_id', 'booking_id');
    }

    public function healthRecords()
    {
        return $this->hasMany(PetHealthRecord::class, 'booking_id', 'booking_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'booking_id', 'booking_id');
    }
}
