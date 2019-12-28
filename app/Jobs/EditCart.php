<?php

namespace App\Jobs;

use App\Cart;
use App\Stock;
use Debugbar;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class EditCart
{
    use Dispatchable, Queueable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $stock = Stock::where('id', $this->cart->stock_id)->first();
        Debugbar::info('stock', $stock);
        if ($this->cart->id) {
            $current_cart = Cart::where('id', $this->cart->id)->first();
            Debugbar::info('current cart', $current_cart);
            if ($stock->stock - ($this->cart->amount - $current_cart->amount) >= 0) {
                $stock->stock = $stock->stock - ($this->cart->amount - $current_cart->amount);
                if ($this->cart->amount == 0) {
                    $this->cart->delete();
                } else {
                    $this->cart->save();
                }
                $stock->save();
            }
        } else if ($stock->stock >= $this->cart->amount) {
            $stock->stock = $stock->stock - $this->cart->amount;
            $stock->save();
            $this->cart->save();
        }
    }
}
