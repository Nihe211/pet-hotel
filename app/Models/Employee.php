<?php

namespace App\Models;

class Employee extends BaseModel
{
    protected $table = 'employee';
    protected $primaryKey = 'employee_id';

    protected $fillable = [
        'user_id',
        'branch_id',
        'full_name',
        'salary',
        'email',
        'phone',
        'hire_date',
        'status_code',
        'note',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
        'hire_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'branch_id');
    }

    public function createdOrders()
    {
        return $this->hasMany(Order::class, 'created_by_emp', 'employee_id');
    }

    public function bookingServicesPet()
    {
        return $this->hasMany(BookingServicePet::class, 'employee_id', 'employee_id');
    }
}
