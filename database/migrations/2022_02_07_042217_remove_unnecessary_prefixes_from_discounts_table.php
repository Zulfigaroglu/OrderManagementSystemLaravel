<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnnecessaryPrefixesFromDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->renameColumn('discount_condition_subject', 'condition_subject');
            $table->renameColumn('discount_condition_type', 'condition_type');
            $table->renameColumn('discount_condition_value', 'condition_value');
            $table->renameColumn('discount_policy_subject', 'policy_subject');
            $table->renameColumn('discount_policy_type', 'policy_type');
            $table->renameColumn('discount_policy_value', 'policy_value');
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
            $table->renameColumn('condition_subject', 'discount_condition_subject');
            $table->renameColumn('condition_type', 'discount_condition_type');
            $table->renameColumn('condition_value', 'discount_condition_value');
            $table->renameColumn('policy_subject', 'discount_policy_subject');
            $table->renameColumn('policy_type', 'discount_policy_type');
            $table->renameColumn('policy_value', 'discount_policy_value');
        });
    }
}
