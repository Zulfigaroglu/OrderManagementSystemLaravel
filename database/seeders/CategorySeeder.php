<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Tornavida Setleri',
                'created_at' => DatabaseSeeder::$createdAt,
            ],
            [
                'id' => 2,
                'name' => 'Elektrik Anahtarları',
                'created_at' => DatabaseSeeder::$createdAt,
            ],
        ]);
    }
}
