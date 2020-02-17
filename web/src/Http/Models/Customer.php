<?php

namespace Emeka\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    	'email', 
  		'first_name',
    	'last_name', 
    	'phone_number', 
    	'image', 
    	'location', 
    	'sex'
    ];
}