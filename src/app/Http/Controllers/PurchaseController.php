<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        Purchase::create([
            'user_id'       => auth()->id(),
            'item_id'       => $request->item_id,
            'postal_code'   => $request->postal_code,
            'address'       => $request->address,
            'building_name' => $request->building_name,
            'payment_method'=> $request->payment_method,
        ]);

        $item->update([ 'is_sold' => true, ]);

        session()->forget('purchase_address');

        return redirect()->route('mypage.index');
    }

}

