<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

	    protected $fillable =['customer_id','issueDate','paid_price','net_total_price','total_expense','total_discount','sale_invoice'];

}
