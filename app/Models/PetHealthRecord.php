<?php

namespace App\Models;

class PetHealthRecord extends BaseModel
{
    protected $table = 'pet_health_record';
    protected $primaryKey = 'health_record_id';

    // CHỈNH SỬA BƯỚC 4: bảng này chỉ có recorded_at, không có created_at/updated_at.
    public $timestamps = false;

    protected $fillable = [
        'pet_id',
        'booking_id',
        'recorded_at',
        'note',
        'status',
    ];

    protected $casts = [
        'recorded_at' => 'datetime',
        'status' => 'boolean',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id', 'pet_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }
}
