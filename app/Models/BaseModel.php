<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    // CHỈNH SỬA BƯỚC 4: các migration dùng $table->id(...) nên khóa chính là số tự tăng.
    public $incrementing = true;

    // CHỈNH SỬA BƯỚC 4: kiểu khóa chính là integer, không còn là string.
    protected $keyType = 'int';
}
