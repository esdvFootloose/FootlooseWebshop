<?php

namespace App\Http\Controllers\Api;

use App\Order;
use App\OrderedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Mollie\Laravel\Facades\Mollie;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            foreach ($order->OrderedItem as $item) {
                $item->Stock;
                $item->Stock->Item;
            }
            $order->User;
        }
        return response()->json(['data' => $orders], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $created_order = Order::create([
            'user_id' => request()->user_id,
        ]);

        foreach (json_decode($request->cart) as $item) {
            $parsed_item = $item;
            OrderedItem::create([
                'order_id' => $created_order->id,
                'stock_id' => $parsed_item->size_id,
                'amount' => $parsed_item->amount
            ]);
        }

        $payment = $this->createPayment($created_order->id);

        $created_order->payment_id = $payment->getCheckoutUrl();
        $created_order->save();
//        return redirect()->to($payment->getCheckoutUrl(), 303);


        return response()->json(['data' => $payment->getCheckoutUrl()], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        foreach (json_decode(request()->data) as $changed_item) {
            $item = OrderedItem::where('order_id', $changed_item->order_id)->where('stock_id', $changed_item->stock_id)->first();
            if ($item) {
                $item->is_picked_up = true;
                $item->save();
            }
        }

        $ordered_items = OrderedItem::where('order_id', $id)->where('is_picked_up', 0)->first();
        if (!$ordered_items) {
            $order = Order::where('id', $id)->first();
            $order->is_picked_up = 1;
            $order->save();
        }
        return response()->json(['data' => 'OK'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['data' => ''], 200);
    }

    private function createPayment($order_id) {
        $order = Order::where('id', $order_id)->first();
        $order_total = 0;

        foreach ($order->OrderedItem as $item) {
            $item->Stock;
            $item->Stock->Item;

            $order_total += $item->amount * $item->Stock->Item->price;
        }
        $order_total = strval(number_format($order_total, 2, '.',''));

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => $order_total
            ],
            'method' => 'ideal',
            'description' => 'Footloose Webshop order ID: '. $order_id,
            'webhookUrl' => route('webhooks.mollie'),
//            'redirectUrl' => route('order.success'),
            'redirectUrl' => 'https://webshop.esdvfootloose.nl',
        ]);

        return Mollie::api()->payments()->get($payment->id);

        // redirect customer to Mollie checkout page
//        return redirect()->to($payment->getCheckoutUrl(), 303);
    }
}
