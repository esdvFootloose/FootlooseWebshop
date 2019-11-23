<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['item_id', 'amount', 'user_id', 'amount'];

}
