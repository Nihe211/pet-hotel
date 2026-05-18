<?php

namespace App\Models;

class TypeRoom extends BaseModel
{
    protected $table = 'type_room';
    protected $primaryKey = 'type_room_id';

    protected $fillable = [
        'type_name',
        'note',
        'max_pets',
        'max_weight_kg',
        'base_price_per_day',
        'is_active',
    ];

    protected $casts = [
        'max_pets' => 'integer',
        'max_weight_kg' => 'decimal:2',
        'base_price_per_day' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'type_room_id', 'type_room_id');
    }
}
