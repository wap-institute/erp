<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysicalStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physical_stock_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("product_name",100)->unique();
            $table->mediumText("product_description")->nullable();
            $table->string("under_group",100);
            $table->string("unit_of_measure",20);
            $table->bigInteger("quantity");
            $table->float("rate",8,2);
            $table->float("amount",8,2);
            $table->mediumText("product_images")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('physical_stock_products');
    }
}
