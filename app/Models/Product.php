<?php

namespace App\Models;

class Product extends BaseModel
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'product_category_id',
        'product_name',
        'unit',
        'cost_price',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'product_category_id', 'product_category_id');
    }

    public function inventories()
    {
        return $this->hasMany(BranchInventory::class, 'product_id', 'product_id');
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_inventory', 'product_id', 'branch_id')
            ->withPivot('inventory_id', 'quantity_on_hand', 'min_quantity')
            ->withTimestamps();
    }

    public function serviceProductStandards()
    {
        return $this->hasMany(ServiceProductStandard::class, 'product_id', 'product_id');
    }
}
