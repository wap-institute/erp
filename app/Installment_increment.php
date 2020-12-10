<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment_increment extends Model
{
    protected $fillable = [
    	'no_of_ins',
    	"percentage",
    ];
}
