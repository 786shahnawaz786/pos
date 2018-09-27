<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    
    protected $fillable=['sale_id','item_id','price','qty','qty_discount','price'];


	    	
}
