<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_registration extends Model
{
     protected $fillable = [
     	'company_name',
          'company_slug',
     	'tagline',
     	'website',
     	'company_email',
     	'founder',
     	'founder_email',
     	'contact_number',
     	'street_address',
     	'city',
     	'state',
     	'country',
     	'pincode',
     	'gstin',
     	'office_starts_at',
     	'office_ends_at',
     	'company_estd',
     	'facebook_url',
     	'twitter_url',
     	'whats_app',
     	'category',
     	'erp_url',
          'password',
     ];
}
