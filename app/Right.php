<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    protected $fillable = ['can_manage_items', 'can_manage_orders', 'can_set_orders_paid'];
}
