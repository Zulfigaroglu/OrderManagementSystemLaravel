<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('products')->insert([
            [
                'name' => 'Black&Decker A7062 40 Parça Cırcırlı Tornavida Seti',
                'category_id' => 1,
                'price' => 120.75,
                'stock' => 10,
                'created_at' => DatabaseSeeder::$createdAt,
            ],
            [
                'name' => 'Reko Mini Tamir Hassas Tornavida Seti 32\'li',
                'category_id' => 1,
                'price' => 49.50,
                'stock' => 10,
                'created_at' => DatabaseSeeder::$createdAt,
            ],
            [
                'name' => 'Viko Karre Anahtar - Beyaz',
                'category_id' => 2,
                'price' => 11.28,
                'stock' => 10,
                'created_at' => DatabaseSeeder::$createdAt,
            ],
            [
                'name' => 'Legrand Salbei Anahtar, Alüminyum',
                'category_id' => 2,
                'price' => 22.80,
                'stock' => 10,
                'created_at' => DatabaseSeeder::$createdAt,
            ],
            [
                'description' => 'Schneider Asfora Beyaz Komütatör',
                'category_id' => 2,
                'price' => 12.95,
                'stock' => 10,
                'created_at' => DatabaseSeeder::$createdAt,
            ]
        ]);
    }
}
