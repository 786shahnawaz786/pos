<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedStock extends Model
{
    protected $fillable=['order_id','quantity','date','purchaseId'];
}
