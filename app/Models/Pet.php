<?php

namespace App\Models;

class Pet extends BaseModel
{
    protected $table = 'pet';
    protected $primaryKey = 'pet_id';

    protected $fillable = [
        'customer_id',
        'pet_name',
        'species',
        'breed',
        'sex',
        'weight_kg',
        'special_note',
    ];

    protected $casts = [
        'weight_kg' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function bookingRoomPets()
    {
        return $this->hasMany(BookingRoomPet::class, 'pet_id', 'pet_id');
    }

    public function bookingRooms()
    {
        return $this->belongsToMany(BookingRoom::class, 'booking_room_pet', 'pet_id', 'booking_room_id')
            ->withPivot('assigned_at', 'note');
    }

    public function bookingServicesPet()
    {
        return $this->hasMany(BookingServicePet::class, 'pet_id', 'pet_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'booking_services_pet', 'pet_id', 'service_id')
            ->withPivot('booking_service_id', 'booking_id', 'employee_id', 'scheduled_at', 'status', 'note')
            ->withTimestamps();
    }

    public function healthRecords()
    {
        return $this->hasMany(PetHealthRecord::class, 'pet_id', 'pet_id');
    }
}
