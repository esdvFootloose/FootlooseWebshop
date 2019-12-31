<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Mollie\Laravel\Facades\Mollie;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPaid extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $items;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $ordered_items = $order->OrderedItem;

        $this->name = $name;
        $this->items = "";

        foreach ($ordered_items as $item) {
            $this->items = $this->items.'- '.$item->amount.'x '.$item->Stock->Item->name.' '.$item->Stock->Item->gender.' '.$item->Stock->size."
";
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.paid');
    }
}
