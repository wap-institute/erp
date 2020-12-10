<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDigitalStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('digital_stock_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product_name',100)->unique();
            $table->mediumText('product_description');
            $table->string('under_group',100);
            $table->float('amount',8,2);
            $table->mediumText('product_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digital_stock_products');
    }
}
