<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function show(Item $item)
    {
        $purchase = Purchase::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'item_id' => $item->id,
            ],
            [
                'postal_code' => Auth::user()->postal_code,
                'address' => Auth::user()->address,
                'building_name' => Auth::user()->building_name,
            ]
        );

        return view('purchase.show', compact('item', 'purchase'));
    }


    public function editAddress(Item $item)
    {
        $user = Auth::user();
        return view('purchase.address-change', compact('item', 'user'));
    }

    public function store(PurchaseRequest $request)
    {
        $item = Item::findOrFail($request->item_id);

        if ($item->is_sold) {
            return redirect()->route('items.index');
        }

        $purchase = Purchase::firstOrCreate(
            [
              'user_id' => Auth::id(),
              'item_id' => $item->id,
            ],
            [
              'postal_code' => Auth::user()->postal_code,
              'address' => Auth::user()->address,
              'building_name' => Auth::user()->building_name,
              'payment_method' => $request->payment_method,
            ]
        );

        $item->update([
        'is_sold' => true,
        ]);

        return redirect()->route('mypage.index');
    }

}
