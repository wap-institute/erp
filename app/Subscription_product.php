<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription_product extends Model
{
    protected $fillable = [
    	"product_name",
    	"product_description",
    	"duration",
    	"duration_in",
    	"one_time_payment",
    	"ins_no",
    	"each_ins",
    	"amount",

    ];
}
