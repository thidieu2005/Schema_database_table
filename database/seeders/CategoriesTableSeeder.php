<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Electronics', 'description' => 'Electronic devices'],
            ['name' => 'Clothing', 'description' => 'Fashion and apparel'],
            ['name' => 'Books', 'description' => 'All kinds of books'],
            ['name' => 'Furniture', 'description' => 'Home and office furniture'],
            ['name' => 'Toys', 'description' => 'Toys for kids of all ages'],
            ['name' => 'Sports', 'description' => 'Equipment and gear for sports'],
            ['name' => 'Beauty', 'description' => 'Skincare, makeup, and grooming products'],
        ]);
    }
}
