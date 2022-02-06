<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public static ?string $createdAt;

    protected array $seeders = [
        CategorySeeder::class,
        ProductSeeder::class,
        DiscountSeeder::class,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        self::$createdAt = Carbon::now()->format('Y-m-d H:i:s');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        collect($this->seeders)->each(function ($class, $key) {
            (new $class)->run();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
