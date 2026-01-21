<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab');

        if ($tab === 'mylist') {

            if (!Auth::check()) {
                $items = collect();
            } else {
                $items = Item::whereHas('likes', function ($query) {
                    $query->where('user_id', Auth::id());
                })->get();
            }

        } else {
            $query = Item::query();

            if (Auth::check()) {
                $query->where('user_id', '!=', Auth::id());
            }

            $items = $query->get();
        }

        return view('items.index', compact('items', 'tab'));
    }



    public function show(Item $item)
    {
        $item = Item::with(['comments.user'])->findOrFail($item->id);
        return view('items.detail', compact('item'));
    }

    public function purchase(Item $item)
    {
        if ($item->is_sold) {
        return redirect()
            ->route('items.index')
            ->with('error', 'この商品はすでに購入されています');
        }

        $user = Auth::user();

        return view('purchase.index', compact('item', 'user'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required',
            'price' => 'required|integer',
        ]);

        $imagePath = $request->file('item_image')->store('items', 'public');

        Item::create([
            'user_id' => auth()->id(),
            'image_path' => $imagePath,
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'condition' => $request->condition,
        ]);

        return redirect()->route('items.index');
    }



}
