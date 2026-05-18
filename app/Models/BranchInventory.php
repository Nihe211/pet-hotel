<?php

namespace App\Models;

class BranchInventory extends BaseModel
{
    protected $table = 'branch_inventory';
    protected $primaryKey = 'inventory_id';

    protected $fillable = [
        'branch_id',
        'product_id',
        'quantity_on_hand',
        'min_quantity',
    ];

    protected $casts = [
        'quantity_on_hand' => 'decimal:2',
        'min_quantity' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
