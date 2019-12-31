<?php

namespace App\Http\Controllers;

use App\Mail\OrderPaid;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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

             $user = User::where('id', $order->user_id)->select('email', 'name')->first();
             Mail::to($user->email)->send(
                 new OrderPaid($user->name, $order->id)
             );
        }
    }
}
