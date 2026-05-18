<?php

namespace App\Models;

class Customer extends BaseModel
{
    protected $table = 'customer';
    protected $primaryKey = 'customer_id';

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'address',
        'note',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function pets()
    {
        return $this->hasMany(Pet::class, 'customer_id', 'customer_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id', 'customer_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'customer_id');
    }
}
