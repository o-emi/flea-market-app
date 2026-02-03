<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $user = auth()->user();

        $address = session('purchase_address')
            ?? [
                'postal_code'   => $user->postal_code,
                'address'       => $user->address,
                'building_name' => $user->building_name,
            ];

        return view('purchase.index', compact('item', 'user', 'address'));
    }

    public function editAddress(Item $item)
    {
        $address = session('purchase_address');

        return view('purchase.address-change', compact('item', 'address'));
    }

    public function storeAddress(AddressRequest $request, Item $item)
    {
        session([
            'purchase_address' => $request->only([
                'postal_code',
                'address',
                'building_name',
            ])
        ]);

        return redirect()->route('purchase.index', $item->id);
    }

    public function store(PurchaseRequest $request)
    {
        $item = Item::findOrFail($request->item_id);

        if ($item->is_sold) {
            return redirect()
                ->route('items.index')
                ->with('error', 'この商品はすでに購入されています');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card', 'konbini'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',

            'metadata' => ['item_id' => $item->id,
            'user_id' => auth()->id(),
            ],

            'success_url' => route('purchase.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'  => route('purchase.cancel'),
        ]);
        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            abort(404);
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return redirect()
                ->route('items.index')
                ->with('error', '決済が完了していません');
        }

        $itemId = $session->metadata->item_id;
        $item   = Item::findOrFail($itemId);
        $userId = $session->metadata->user_id;

        if ($item->is_sold) {
            return redirect()->route('items.index');
        }

        $address = session('purchase_address') ?? [
            'postal_code'   => auth()->user()->postal_code,
            'address'       => auth()->user()->address,
            'building_name' => auth()->user()->building_name,
        ];

        Purchase::create([
            'user_id'       => $userId,
            'item_id'       => $item->id,
            'postal_code'   => $address['postal_code'],
            'address'       => $address['address'],
            'building_name' => $address['building_name'],
            'payment_method'=> 'stripe',
        ]);


        $item->update(['is_sold' => true]);

        session()->forget('purchase_address');

        return view('purchase.success');
    }

    public function cancel()
    {
        return view('purchase.cancel');
    }
}

