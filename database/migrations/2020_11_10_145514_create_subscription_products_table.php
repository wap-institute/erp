<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("product_name",100)->unique();
            $table->mediumText("product_description")->nullable();
            $table->integer("duration");
            $table->string("duration_in",20);
            $table->float("one_time_payment",8,2);
            $table->mediumText("ins_no")->nullable();
            $table->mediumText("each_ins")->nullable();
            $table->mediumText("amount")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_products');
    }
}
