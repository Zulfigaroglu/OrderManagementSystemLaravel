<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    private array $discountConditionSubjects = [
        'total_price',
        'product_quantity',
        'item_count',
    ];

    private array $discountConditionTypes = [
        'higher_than_value',
        'each_times_of_value',
    ];

    private array $discountPolicySubjects = [
        'order',
        'any_item',
        'cheapest_item',
    ];

    private array $discountPolicyTypes = [
        'discount_by_percantage',
        'discount_by_total',
        'give_free',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->enum('discount_condition_subject', $this->discountConditionSubjects);
            $table->enum('discount_condition_type', $this->discountConditionTypes);
            $table->integer('discount_condition_value');
            $table->enum('discount_policy_subject', $this->discountPolicySubjects);
            $table->enum('discount_policy_type', $this->discountPolicyTypes);
            $table->integer('discount_policy_value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('discounts', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('discounts');
    }
}
