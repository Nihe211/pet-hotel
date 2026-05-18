<?php

namespace App\Models;

class ServiceProductStandard extends BaseModel
{
    protected $table = 'service_product_standard';
    protected $primaryKey = 'standard_id';

    protected $fillable = [
        'service_id',
        'product_id',
        'species',
        'min_weight_kg',
        'max_weight_kg',
        'usage_amount',
        'usage_unit',
        'note',
    ];

    protected $casts = [
        'min_weight_kg' => 'decimal:2',
        'max_weight_kg' => 'decimal:2',
        'usage_amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'service_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
