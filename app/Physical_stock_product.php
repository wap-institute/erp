<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Physical_stock_product extends Model
{
   protected $fillable = [
   	"product_name",
   	"product_description",
   	"under_group",
   	"unit_of_measure",
   	"quantity",
   	"rate",
   	"amount",
   	"product_images",
   ];
}
