<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Physical_stock_group extends Model
{
    protected $fillable = [
    	'group_name',
    	'under_group',
    ];
}
