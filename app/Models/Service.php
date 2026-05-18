<?php

namespace App\Models;

class Service extends BaseModel
{
    protected $table = 'services';
    protected $primaryKey = 'service_id';

    protected $fillable = [
        'service_category_id',
        'service_name',
        'species',
        'description_sv',
        'base_price',
        'duration_minutes',
        'is_active',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'duration_minutes' => 'integer',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryService::class, 'service_category_id', 'service_category_id');
    }

    public function bookingServicesPet()
    {
        return $this->hasMany(BookingServicePet::class, 'service_id', 'service_id');
    }

    public function serviceProductStandards()
    {
        return $this->hasMany(ServiceProductStandard::class, 'service_id', 'service_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'service_product_standard', 'service_id', 'product_id')
            ->withPivot('standard_id', 'species', 'min_weight_kg', 'max_weight_kg', 'usage_amount', 'usage_unit', 'note')
            ->withTimestamps();
    }
}
