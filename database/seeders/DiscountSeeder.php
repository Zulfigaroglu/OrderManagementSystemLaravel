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
                'discount_condition_subject' => 'total_price',
                'discount_condition_type' => 'higher_than_value',
                'discount_condition_value' => 1000,
                'discount_policy_subject' => 'order',
                'discount_policy_type' => 'discount_by_percantage',
                'discount_policy_value' => 10,
            ],
            [
                'name' => 'BUY_5_GET_1',
                'category_id' => 2,
                'discount_condition_subject' => 'product_quantity',
                'discount_condition_type' => 'each_times_of_value',
                'discount_condition_value' => 6,
                'discount_policy_subject' => 'any_item',
                'discount_policy_type' => 'give_free',
                'discount_policy_value' => null,
            ],
        ]);
    }
}
