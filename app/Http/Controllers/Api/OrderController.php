<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Jobs\EditCart;
use App\Mail\OrderCreated;
use App\Mail\OrderPaid;
use App\Order;
use App\OrderedItem;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Mollie\Laravel\Facades\Mollie;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have persmission"], 403);
        }
        $orders = Order::all();
        foreach ($orders as $order) {
            foreach ($order->OrderedItem as $item) {
                $item->Stock;
                $item->Stock->Item;
                $item->Stock->Item->image = count($image = $item->Stock->Item->getMedia('product')) > 0 ? $image[0]->getUrl() : '/images/placeholder.png';
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
            'user_id' => auth()->user()->id,
        ]);

        foreach (json_decode($request->cart) as $item) {
            OrderedItem::create([
                'order_id' => $created_order->id,
                'stock_id' => $item->stock_id,
                'amount' => $item->amount,
            ]);
        }
        $payment = $this->createPayment($created_order->id);

        $created_order->payment_id = $payment->id;
        $created_order->save();

        $this->removeCart();

        // Todo check if this works with FL login
        Mail::to(auth()->user()->email)->send(
            new OrderCreated(auth()->user()->name, $created_order->id)
        );

        return response()->json(['data' => $payment->getCheckoutUrl()], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();
        if ($order->user_id != auth()->user()->id) {
            return response()->json(['Data' => 'Error, you are not allowed to view this order'], 401);
        }
        foreach ($order->OrderedItem as $item) {
            $item->Stock;
            $item->Stock->Item;
            $item->Stock->Item->image = count($image = $item->Stock->Item->getMedia('product')) > 0 ? $image[0]->getUrl() : '/images/placeholder.png';
        }
        $old_payment = Mollie::api()->payments()->get($order->payment_id);

        // Todo check if working with FL credentials
        if (!$order->is_paid && $old_payment->isPaid()) {
            $order->is_paid = true;
            $user = User::where('id', $order->user_id)->select('email', 'name')->first();
            Mail::to($user->email)->send(
                new OrderPaid($user->name, $order->id)
            );
        }

        if (!$old_payment->isPaid() && !$old_payment->isOpen()) {
            $payment = Mollie::api()->payments()->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => $old_payment->amount->value,
                ],
                'method' => 'ideal',
                'description' => 'Footloose mechendise  order #: ' . $order->id,
                'webhookUrl' => route('webhooks.mollie'),
                'redirectUrl' => route('spa', ['any' => 'order/' . $order->id]),
            ]);
            $order->payment_id = $payment->id;
            $order->save();
            $order->payment_url = Mollie::api()->payments()->get($payment->id)->getCheckoutUrl();
        } else if ($old_payment->isOpen()) {
            $order->payment_url = Mollie::api()->payments()->get($old_payment->id)->getCheckoutUrl();
        }
        $order->User;
        return response()->json(['data' => $order], 200);
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
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }

        $order = Order::where('id', $id)->first();
        $ordered_items = $order->OrderedItem;
        foreach (json_decode(request()->data) as $changed_item) {
            $item = OrderedItem::where('order_id', $changed_item->order_id)->where('stock_id', $changed_item->stock_id)->first();

            // Case where the ordered item is different from the pickup
            if (!$item) {
                $cart = new Cart([
                    'stock_id' => $changed_item->stock_id,
                    'amount' => $changed_item->amount,
                    'user_id' => Auth::user()->id,
                    'expires_at' => Carbon::now()->addMinutes(15)->toDateTimeString()
                ]);
                EditCart::dispatchNow($cart);
                $added_item = Cart::where('stock_id', $cart->stock_id)
                    ->where('user_id', $cart->user_id)
                    ->where('amount', $cart->amount)
                    ->where('expires_at', $cart->expires_at)
                    ->first();
                if ($added_item) {
                    $old_cart = Cart::create([
                        'stock_id' => $changed_item->old_stock,
                        'amount' => 0,
                        'user_id' => Auth::user()->id,
                        'expires_at' => Carbon::now()->addMinutes(15)->toDateTimeString()
                    ]);
                    $old_cart->amount = -1 * $changed_item->amount;
                    EditCart::dispatchNow($old_cart);
                    $item = OrderedItem::where('order_id', $changed_item->order_id)->where('stock_id', $changed_item->old_stock)->first();
                    $item->stock_id = $changed_item->stock_id;
                    $item->save();
                } else {
                    return response()->json(['data' => 'Error: not sufficient stock'], 409);
                }
            } else {
                // else change is that item is picked up
                $item->is_picked_up = true;
                $item->save();
            }
        }

        // If all items picked up, set order as finished/picked up
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
    public function destroy(Request $request, Order $order)
    {
        if (!$request->user()->hasRole('admin')) {
            return response()->json(['Error' => "You don't have permission"], 403);
        }
        $order->delete();
        return response()->json(['data' => ''], 200);
    }

    private function createPayment($order_id)
    {
        $order = Order::where('id', $order_id)->first();
        $order_total = 0;

        foreach ($order->OrderedItem as $item) {
            $item->Stock;
            $item->Stock->Item;

            $order_total += $item->amount * $item->Stock->Item->price;
        }
        $order_total += env('MOLLIE_ADDED_COSTS', 0.36); // Add transaction costs

        $order_total = strval(number_format($order_total, 2, '.', ''));

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => $order_total,
            ],
            'method' => 'ideal',
            'description' => 'Footloose merchandise  order #: ' . $order_id,
            'webhookUrl' => route('webhooks.mollie'),
            'redirectUrl' => route('spa', ['any' => 'order/' . $order_id]),
        ]);

        return Mollie::api()->payments()->get($payment->id);

    }

    private function removeCart()
    {
        Cart::where('user_id', auth()->user()->id)->delete();
    }
}
