<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Item $item)
    {
        $user = Auth::user();

        $like = $user->likes()->where('item_id', $item->id)->first();

        if ($like) {
            $like->delete();
        } else {
            $user->likes()->create([
                'item_id' => $item->id,
            ]);
        }

        return back();
    }
}
