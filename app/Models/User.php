<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // CHỈNH SỬA BƯỚC 4: bảng tài khoản trong migration là app_user, không phải users.
    protected $table = 'app_user';

    protected $primaryKey = 'user_id';

    // CHỈNH SỬA BƯỚC 4: user_id dùng $table->id() nên là số tự tăng.
    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'password_hash',
        'role_emp',
        'user_name',
        'is_active',
        'last_login',
    ];

    protected $hidden = [
        'password_hash',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_login' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // CHỈNH SỬA BƯỚC 4: Laravel Auth mặc định tìm password, trong DB đang dùng password_hash.
    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'user_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'user_id');
    }
}
