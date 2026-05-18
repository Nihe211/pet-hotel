<?php

namespace App\Models;

class CategoryService extends BaseModel
{
    protected $table = 'category_services';
    protected $primaryKey = 'service_category_id';

    protected $fillable = [
        'category_name',
        'note',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function services()
    {
        return $this->hasMany(Service::class, 'service_category_id', 'service_category_id');
    }
}
