<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->truncate();
        DB::table('discounts')->insert([
            [
                'name' => '10_PERCENT_OVER_1000',
                'category_id' => null,
                'condition_subject' => 'total_price',
                'condition_type' => 'higher_than_value',
                'condition_value' => 1000,
                'policy_subject' => 'order',
                'policy_type' => 'discount_by_percantage',
                'policy_value' => 10,
            ],
            [
                'name' => 'BUY_5_GET_1',
                'category_id' => 2,
                'condition_subject' => 'product_quantity',
                'condition_type' => 'each_times_of_value',
                'condition_value' => 6,
                'policy_subject' => 'any_item',
                'policy_type' => 'give_free',
                'policy_value' => null,
            ],
        ]);
    }
}
