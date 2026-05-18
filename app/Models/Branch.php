<?php

namespace App\Models;

class Branch extends BaseModel
{
    protected $table = 'branch';
    protected $primaryKey = 'branch_id';

    protected $fillable = [
        'branch_name',
        'phone',
        'email',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'branch_id', 'branch_id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'branch_id', 'branch_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'branch_id', 'branch_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'branch_id', 'branch_id');
    }

    public function inventories()
    {
        return $this->hasMany(BranchInventory::class, 'branch_id', 'branch_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'branch_inventory', 'branch_id', 'product_id')
            ->withPivot('inventory_id', 'quantity_on_hand', 'min_quantity')
            ->withTimestamps();
    }
}
