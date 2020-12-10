<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Digital_stock_product extends Model
{
    protected $fillable = [
    	"product_name",
    	"product_description",
    	"under_group",
    	"amount",
    	"product_image",

    ];
}
