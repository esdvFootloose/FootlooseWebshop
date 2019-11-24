<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['stock_id', 'amount', 'user_id', 'expires_at'];

    public function Stock()
    {
        return $this->belongsTo(Stock::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
