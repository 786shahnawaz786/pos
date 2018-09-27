<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable =['supplier','issueDate','receiveDate','tax','from_loc','to_loc','status','total_amount','invoiceNo'];
}
