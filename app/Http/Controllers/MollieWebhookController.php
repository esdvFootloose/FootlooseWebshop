<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class MollieWebhookController extends Controller {
    public function handle(Request $request) {
        if (! $request->has('id')) {
            return;
        }

        $payment = Mollie::api()->payments()->get($request->id);

        if ($payment->isPaid()) {
             $order = Order::where('payment_id', $request->id)->first();
             $order->is_paid = true;
             $order->save();
        }
    }
}
