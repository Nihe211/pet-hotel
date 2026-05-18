<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PetSeeder extends Seeder
{
    public function run(): void
    {
        /* CHỈNH SỬA BƯỚC 5: pet phụ thuộc customer nên seed sau CustomerSeeder. */
        DB::table('pet')->insert([
            [
                'pet_id' => 1,
                'customer_id' => 1,
                'pet_name' => 'Milo',
                'species' => 'DOG',
                'breed' => 'Poodle',
                'sex' => 'MALE',
                'weight_kg' => 5.20,
                'special_note' => 'Dị ứng nhẹ với hải sản.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 2,
                'customer_id' => 2,
                'pet_name' => 'Miu',
                'species' => 'CAT',
                'breed' => 'British Shorthair',
                'sex' => 'FEMALE',
                'weight_kg' => 4.10,
                'special_note' => 'Hay sợ tiếng ồn.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 3,
                'customer_id' => 3,
                'pet_name' => 'Bông',
                'species' => 'DOG',
                'breed' => 'Corgi',
                'sex' => 'FEMALE',
                'weight_kg' => 10.50,
                'special_note' => 'Cần đi dạo mỗi chiều.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
