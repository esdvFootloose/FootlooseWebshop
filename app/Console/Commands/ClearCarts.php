<?php

namespace App\Console\Commands;

use App\Cart;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cart:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to clear the cart items which are out of date in order to disallow blocking items';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $items = Cart::whereDate('expires_at' , '<=', Carbon::now()->toDateTimeString());
        foreach($items as $item)
        {
            $item->destroy();
        }
    }
}
