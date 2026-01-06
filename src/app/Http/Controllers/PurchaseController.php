<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function store(PurchaseRequest $request)
    {
        $item = Item::findOrFail($request->item_id);

        if ($item->is_sold) {
            return redirect()->route('items.index');
        }

    Purchase::create([
        'user_id' => Auth::id(),
        'item_id' => $item->id,
    ]);

    $item->update([
        'is_sold' => true,
    ]);

    return redirect()->route('mypage.index');
    }
}
