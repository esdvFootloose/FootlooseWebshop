<?php

namespace App\Jobs;

use App\Cart;
use App\Stock;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddToCart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $cart;

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
        /**
         * If the cart already contains the item but the quantities are different, update both cart and stock, else 
         */
        $stock = Stock::where('id', $this->cart->stock_id)->first();
        if ($this->cart->id) {
            $current_cart = Cart::where('id', $this->cart->id);
            if ($stock->stock - ($this->cart->amount - $current_cart->amount) >= 0) {
                $stock->stock = $stock->stock - ($this->cart->amount - $current_cart->amount);
                $stock->save();
                $this->cart->save();
            }
        } else if ($stock->stock >= $this->cart->amount) {
            $stock->stock = $stock->stock - $this->cart->amount;
            $stock->save();
            $this->cart->save();
        }
    }
}
