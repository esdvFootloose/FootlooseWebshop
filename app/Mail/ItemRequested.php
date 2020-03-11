<?php

namespace App\Mail;

use App\ItemRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ItemRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $item, $amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $request_id)
    {
        $item_request = ItemRequest::where('id', $request_id)->first();

        $this->name = $name;
        $this->item = $item_request->Item;
        $this->amount = $item_request->amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.requested');
    }
}
