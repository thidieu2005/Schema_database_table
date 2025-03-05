<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Lấy tất cả các ID của categories từ database
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        if (empty($categoryIds)) {
            $this->command->warn("⚠️ Không có danh mục nào trong bảng categories! Hãy chạy CategoriesTableSeeder trước.");
            return;
        }

        foreach (range(1, 100) as $index) {
            DB::table('products')->insert([
                'name' => $faker->word,
                'price' => $faker->numberBetween(100000, 5000000),
                'img' => $faker->imageUrl(200, 200, 'technics'),
                'cate_id' => $faker->randomElement($categoryIds), // Chọn ID hợp lệ từ bảng categories
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("✅ Products seeded successfully!");
    }
}
